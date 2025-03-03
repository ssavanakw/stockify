<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StockTransaction;

class StockTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = [
            ["material_id" => 1, 
            "type" => "in", 
            "quantity" => 200, 
            "transaction_date" => 
            "2025-03-01", 
            "description" => "Stok awal"],
            ["material_id" => 2, 
            "type" => "out", 
            "quantity" => 50, 
            "transaction_date" => "2025-03-02", 
            "description" => "Pengiriman ke cabang"],
            ["material_id" => 3, 
            "type" => "in", 
            "quantity" => 100, 
            "transaction_date" => "2025-03-03", 
            "description" => "Restock bahan kimia"],
            ["material_id" => 4, 
            "type" => "out", 
            "quantity" => 20, 
            "transaction_date" => "2025-03-04", 
            "description" => "Penjualan ke pelanggan"],
            ["material_id" => 5, 
            "type" => "in", 
            "quantity" => 150, 
            "transaction_date" => "2025-03-05", 
            "description" => "Pemasokan bahan baru"],
            ["material_id" => 6, 
            "type" => "out", 
            "quantity" => 30, 
            "transaction_date" => "2025-03-06", 
            "description" => "Dikirim ke pabrik"],
            ["material_id" => 7, 
            "type" => "in", 
            "quantity" => 75, 
            "transaction_date" => "2025-03-07", 
            "description" => "Penerimaan barang dari supplier"],
            ["material_id" => 8, 
            "type" => "out", 
            "quantity" => 40, 
            "transaction_date" => "2025-03-08", 
            "description" => "Pengiriman ke gudang lain"],
            ["material_id" => 9, 
            "type" => "in", 
            "quantity" => 90, 
            "transaction_date" => "2025-03-09", 
            "description" => "Stock tambahan"],
            ["material_id" => 10, 
            "type" => "out", 
            "quantity" => 60, 
            "transaction_date" => "2025-03-10", 
            "description" => "Dikirim ke klien utama"],
        ];
        foreach ($transactions as $transaction) {
            StockTransaction::create($transaction);
        }
    }
}
