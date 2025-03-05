<?php

namespace App\Repositories;

use App\Models\StockTransaction;

class StockTransactionRepository
{
    public function paginateTransactions($perPage = 10)
    {
        return StockTransaction::with('material')
            ->orderByDesc('transaction_date') // Order terbaru di atas
            ->paginate($perPage);
    }

    public function create(array $data)
    {
        return StockTransaction::create($data);
    }

    public function getAll()
    {
        return StockTransaction::with('material')->latest()->get();
    }
}
