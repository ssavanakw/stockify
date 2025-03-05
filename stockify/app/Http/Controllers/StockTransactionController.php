<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Material;
use App\Models\StockTransaction;
use App\Services\StockTransactionService;

class StockTransactionController extends Controller
{
    protected $stockTransactionService;

    public function __construct(StockTransactionService $stockTransactionService)
    {
        $this->stockTransactionService = $stockTransactionService;
    }

    public function index()
    {
        $transactions = $this->stockTransactionService->getPaginatedTransactions();
        return view('pages.stock_transactions.index', compact('transactions'));
    }

    public function create()
    {
        $materials = Material::all();
        return view('pages.stock_transactions.create', compact('materials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'material_id' => 'required|exists:materials,id',
            'quantity' => 'required|integer|min:1',
            'transaction_type' => 'required|in:in,out',
            'description' => 'nullable|string|max:255',
        ]);
    
        try {
            DB::transaction(function () use ($request) {
                $material = Material::findOrFail($request->material_id);
    
                if ($request->transaction_type === 'out' && $material->stock < $request->quantity) {
                    throw new \Exception('Stock not sufficient!');
                }
    
                StockTransaction::create([
                    'material_id' => $request->material_id,
                    'quantity' => $request->quantity,
                    'price' => $material->price,
                    'transaction_type' => $request->transaction_type,
                    'description' => $request->description,
                    'user_id' => Auth::id(),
                    'transaction_date' => now(),
                ]);
    
                // Update stock
                if ($request->transaction_type === 'in') {
                    $material->stock += $request->quantity;
                } else {
                    $material->stock -= $request->quantity;
                }
                $material->save();
            });
    
            return redirect()->route('stock-transactions.index')->with('success', 'Transaction added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('stock-transactions.index')->with('error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $transaction = StockTransaction::findOrFail($id);
            $material = Material::findOrFail($transaction->material_id);

            if ($transaction->transaction_type === 'in') {
                $material->stock -= $transaction->quantity;
            } elseif ($transaction->transaction_type === 'out') {
                $material->stock += $transaction->quantity;
            }
            $material->save();

            $transaction->delete();
        });

        return redirect()->route('stock-transactions.index')->with('success', 'Transaction cancelled and stock restored!');
    }
}
