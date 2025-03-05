<?php

namespace App\Repositories;

interface StockTransactionRepositoryInterface
{
    public function getPaginatedTransactions($perPage = 10);

    public function createTransaction(array $data);

    public function getTransactionById($id);

    public function deleteTransaction($id);
}
