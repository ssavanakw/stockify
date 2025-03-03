<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Report;

class ReportSeeder extends Seeder
{
/**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reports = [
            [
                "title" => "Pembubaran Partai",
                "description" => "3 Partai me-rusuh di jalanan",
                "user_id" => 1,
                "role" => "Manager",
                "status" => "pending",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Laporan Kerusakan Barang",
                "description" => "Barang di gudang mengalami kerusakan akibat hujan",
                "user_id" => 2,
                "role" => "Staff",
                "status" => "Completed",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Keterlambatan Pengiriman",
                "description" => "Pengiriman barang dari supplier mengalami keterlambatan.",
                "user_id" => 3,
                "role" => "Admin",
                "status" => "pending",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Kesalahan Stok Gudang",
                "description" => "Perbedaan stok barang dengan data sistem.",
                "user_id" => 4,
                "role" => "Staff",
                "status" => "Completed",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Kerusakan Peralatan Gudang",
                "description" => "Beberapa alat di gudang mengalami kerusakan.",
                "user_id" => 5,
                "role" => "Manager",
                "status" => "pending",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Kehilangan Barang",
                "description" => "Beberapa barang hilang dalam proses distribusi.",
                "user_id" => 6,
                "role" => "Staff",
                "status" => "pending",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Permintaan Tambahan Gudang",
                "description" => "Permintaan tambahan rak untuk penyimpanan barang.",
                "user_id" => 7,
                "role" => "Admin",
                "status" => "Completed",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Pelanggaran Prosedur Keamanan",
                "description" => "Ada pelanggaran prosedur keamanan di gudang.",
                "user_id" => 8,
                "role" => "Manager",
                "status" => "pending",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Penumpukan Barang di Gudang",
                "description" => "Terlalu banyak barang yang menumpuk, perlu pengelolaan ulang.",
                "user_id" => 9,
                "role" => "Staff",
                "status" => "Completed",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Perubahan Jadwal Operasional",
                "description" => "Gudang mengalami perubahan jadwal operasional.",
                "user_id" => 10,
                "role" => "Admin",
                "status" => "pending",
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];


        foreach ($reports as $report) {
            Report::create($report);
        }
    }
}
