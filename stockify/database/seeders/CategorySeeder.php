<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            "Kimia",
            "Elektronik",
            "Mekanik",
            "Gelas Mudah Pecah",
            "Korosif",
            "Farmasi",
            "Otomotif",
            "Makanan & Minuman",
            "Pertanian",
            "Peralatan Medis",
            "Bahan Bangunan",
            "Tekstil",
            "Peralatan Rumah Tangga",
            "Peralatan Kantor",
            "Energi Terbarukan",
        ];


        foreach ($categories as $category) {
            Category::create([
                "name" => $category,
                "slug" => Str::slug($category),
            ]);
        }
    }

}
