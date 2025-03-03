<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
/**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                "name" => "Supplier A",
                "email" => "supplierA@gmail.com",
                "phone" => "081234567890",
                "address" => "Jl. Raya No. 1"
            ],
            [
                "name" => "Supplier B",
                "email" => "supplierB@gmail.com",
                "phone" => "081298765432",
                "address" => "Jl. Mawar No. 2"
            ],
            [
                "name" => "Supplier C",
                "email" => "supplierC@gmail.com",
                "phone" => "081212341234",
                "address" => "Jl. Melati No. 3"
            ],
            [
                "name" => "Supplier D",
                "email" => "supplierD@gmail.com",
                "phone" => "081234123456",
                "address" => "Jl. Anggrek No. 4"
            ],
            [
                "name" => "Supplier E",
                "email" => "supplierE@gmail.com",
                "phone" => "081267890123",
                "address" => "Jl. Cemara No. 5"
            ],
            [
                "name" => "Supplier F",
                "email" => "supplierF@gmail.com",
                "phone" => "081278901234",
                "address" => "Jl. Kenanga No. 6"
            ],
            [
                "name" => "Supplier G",
                "email" => "supplierG@gmail.com",
                "phone" => "081289012345",
                "address" => "Jl. Flamboyan No. 7"
            ],
            [
                "name" => "Supplier H",
                "email" => "supplierH@gmail.com",
                "phone" => "081290123456",
                "address" => "Jl. Cempaka No. 8"
            ],
            [
                "name" => "Supplier I",
                "email" => "supplierI@gmail.com",
                "phone" => "081301234567",
                "address" => "Jl. Dahlia No. 9"
            ],
            [
                "name" => "Supplier J",
                "email" => "supplierJ@gmail.com",
                "phone" => "081312345678",
                "address" => "Jl. Bougenville No. 10"
            ],
        ];
        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
