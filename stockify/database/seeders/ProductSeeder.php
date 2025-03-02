<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Material::create([
            "name" => "Material 1",
            "description" => "This is a sample material.",
            "price" => 100000,
            "stock" => 100,
            "category_id" => "1",
        ]);
    }
}
