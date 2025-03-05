<?php

namespace App\Services;

use App\Repositories\StockTransactionRepository;

class StockTransactionService
{
    protected $stockTransactionRepository;

    public function __construct(StockTransactionRepository $stockTransactionRepository)
    {
        $this->stockTransactionRepository = $stockTransactionRepository;
    }

    public function createStockTransaction(array $data)
    {
        return $this->stockTransactionRepository->create($data);
    }

    public function getStockTransactions()
    {
        return $this->stockTransactionRepository->getAll();
    }
    public function getPaginatedTransactions($perPage = 10)
    {
        return $this->stockTransactionRepository->paginateTransactions($perPage);
    }
}
