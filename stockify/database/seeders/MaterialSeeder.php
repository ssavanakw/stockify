<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            ["name" => "Avac", 
            "description" => "-", 
            "price" => 14214, "stock" => 12, 
            "category_id" => 1],
            ["name" => "Sodium Chloride", 
            "description" => "Garam industri berkualitas tinggi.", 
            "price" => 50000, "stock" => 50, 
            "category_id" => 2],
            ["name" => "Ethanol", 
            "description" => "Bahan kimia pelarut organik.", 
            "price" => 75000, 
            "stock" => 20, 
            "category_id" => 1],
            ["name" => "Sulfuric Acid", 
            "description" => "Asam kuat yang digunakan dalam industri.", 
            "price" => 100000, 
            "stock" => 10, 
            "category_id" => 3],
            ["name" => "Hydrochloric Acid", 
            "description" => "Bahan kimia dengan pH rendah.", 
            "price" => 85000, 
            "stock" => 15, 
            "category_id" => 3],
            ["name" => "Acetone", 
            "description" => "Pelarut organik yang umum digunakan.", 
            "price" => 65000, 
            "stock" => 25, 
            "category_id" => 1],
            ["name" => "Aluminum Sulfate", 
            "description" => "Digunakan dalam pemurnian air.", 
            "price" => 45000, 
            "stock" => 30, 
            "category_id" => 2],
            ["name" => "Calcium Carbonate", 
            "description" => "Bahan pengisi dalam berbagai industri.", 
            "price" => 30000, 
            "stock" => 40, 
            "category_id" => 2],
            ["name" => "Methanol", 
            "description" => "Bahan kimia cair yang mudah terbakar.", 
            "price" => 72000, 
            "stock" => 18, 
            "category_id" => 1],
            ["name" => "Benzene", 
            "description" => "Komponen dasar dalam industri kimia.", 
            "price" => 92000, 
            "stock" => 12, 
            "category_id" => 3],
            ["name" => "Toluene", 
            "description" => "Pelarut untuk berbagai aplikasi industri.", 
            "price" => 78000, 
            "stock" => 20, 
            "category_id" => 1],
            ["name" => "Phenol", 
            "description" => "Bahan baku dalam pembuatan resin.", 
            "price" => 110000, 
            "stock" => 8, 
            "category_id" => 3],
            ["name" => "Ammonia", 
            "description" => "Digunakan dalam industri pupuk.", 
            "price" => 95000, 
            "stock" => 22, "category_id" => 3],
            ["name" => "Sodium Hydroxide", 
            "description" => "Basa kuat untuk berbagai keperluan industri.", 
            "price" => 88000, 
            "stock" => 17, 
            "category_id" => 2],
            ["name" => "Chloroform", 
            "description" => "Pelarut kimia dengan volatilitas tinggi.", 
            "price" => 102000, 
            "stock" => 5, 
            "category_id" => 1],
        ];

        foreach ($materials as $material) {
            Material::create($material);
        }
    }
}
