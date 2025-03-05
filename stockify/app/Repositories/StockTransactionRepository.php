<?php

namespace App\Repositories;

use App\Models\StockTransaction;

class StockTransactionRepository
{
    public function getPaginatedTransactions($perPage = 10)
    {
        return StockTransaction::with('material', 'user')->orderBy('transaction_date', 'desc')->paginate($perPage);
    }

    public function createTransaction($data)
    {
        return StockTransaction::create($data);
    }

    public function getTransactionById($id)
    {
        return StockTransaction::findOrFail($id);
    }

    public function deleteTransaction($id)
    {
        $transaction = StockTransaction::findOrFail($id);
        return $transaction->delete();
    }
}
