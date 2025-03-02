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
        $transactions = StockTransaction::with('material')->latest()->get(); // Ambil data terbaru
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

        DB::transaction(function () use ($request) {
            $material = Material::findOrFail($request->material_id);

            if ($request->transaction_type == 'out' && $material->stock < $request->quantity) {
                return back()->with('error', 'Stock not sufficient!');
            }
            
            // Hapus titik pemisah ribuan dari input harga sebelum menyimpan
            $price = $material->price; 

            StockTransaction::create([
                'material_id' => $request->material_id,
                'quantity' => $request->quantity,
                'price' => $price,
                'transaction_type' => $request->transaction_type,
                'description' => $request->description,
                'user_id' => Auth::id(),
                'transaction_date' => now(), // Set tanggal transaksi otomatis
            ]);

            // Update stok material
            if ($request->transaction_type == 'in') {
                $material->stock += $request->quantity;
            } else {
                $material->stock -= $request->quantity;
            }
            $material->touch();
            $material->save();
        });

        return redirect()->route('stock-transactions.index')->with('success', 'Transaction added successfully!');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $transaction = StockTransaction::findOrFail($id);
            $material = Material::findOrFail($transaction->material_id);

            // Kembalikan stok jika transaksi dibatalkan
            if ($transaction->transaction_type == 'in') {
                $material->stock -= $transaction->quantity;
            } else {
                $material->stock += $transaction->quantity;
            }
            $material->save();

            $transaction->delete();
        });

        return redirect()->route('stock-transactions.index')->with('success', 'Transaction cancelled and stock restored!');
    }
}
