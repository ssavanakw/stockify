<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Report;
use App\Models\Supplier;
use App\Models\Material;
use App\Models\StockTransaction;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            MaterialSeeder::class,
            UserSeeder::class,
            StockTransactionSeeder::class,
            SupplierSeeder::class,
            ReportSeeder::class,
        ]);
    }
}
