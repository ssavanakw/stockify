<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
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
        $validated = $request->validate([
            'material_id' => 'required|exists:materials,id',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|in:in,out',
            'description' => 'nullable|string|max:255',
        ]);

        try {
            $this->stockTransactionService->createTransaction($validated);
            return redirect()->route('stock-transactions.index')->with('success', 'Transaction added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('stock-transactions.index')->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->stockTransactionService->deleteTransaction($id);
            return redirect()->route('stock-transactions.index')->with('success', 'Transaction cancelled and stock restored!');
        } catch (\Exception $e) {
            return redirect()->route('stock-transactions.index')->with('error', $e->getMessage());
        }
    }
}
