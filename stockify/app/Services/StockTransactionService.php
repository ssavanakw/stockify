<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\StockTransactionRepository;
use App\Models\Material;

class StockTransactionService
{
    protected $stockTransactionRepository;

    public function __construct(StockTransactionRepository $stockTransactionRepository)
    {
        $this->stockTransactionRepository = $stockTransactionRepository;
    }

    public function getPaginatedTransactions($perPage = 10)
    {
        return $this->stockTransactionRepository->getPaginatedTransactions($perPage);
    }

    public function createTransaction($data)
    {
        return DB::transaction(function () use ($data) {
            $material = Material::findOrFail($data['material_id']);

            if ($data['type'] === 'out' && $material->stock < $data['quantity']) {
                throw new \Exception('Stock not sufficient!');
            }

            $transaction = $this->stockTransactionRepository->createTransaction([
                'material_id' => $data['material_id'],
                'quantity' => $data['quantity'],
                'price' => $material->price,
                'type' => $data['type'],
                'description' => $data['description'],
                'user_id' => Auth::id(),
                'transaction_date' => now(),
            ]);

            // Update stock
            if ($data['type'] === 'in') {
                $material->stock += $data['quantity'];
            } else {
                $material->stock -= $data['quantity'];
            }
            $material->save();

            return $transaction;
        });
    }

    public function deleteTransaction($id)
    {
        return DB::transaction(function () use ($id) {
            $transaction = $this->stockTransactionRepository->getTransactionById($id);
            $material = Material::findOrFail($transaction->material_id);

            if ($transaction->transaction_type === 'in') {
                $material->stock -= $transaction->quantity;
            } elseif ($transaction->transaction_type === 'out') {
                $material->stock += $transaction->quantity;
            }
            $material->save();

            return $this->stockTransactionRepository->deleteTransaction($id);
        });
    }
}
