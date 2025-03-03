<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;

class TaskSeeder extends Seeder
{
/**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua user dengan role staff
        $staffUsers = User::where('role', 'staff')->get();

        // Jika belum ada staff, buat beberapa staff dulu
        if ($staffUsers->isEmpty()) {
            $staffUsers = User::factory(5)->create(['role' => 'staff']);
        }

        // Buat 10 task dengan user staff yang ada
        for ($i = 0; $i < 10; $i++) {
            Task::factory()->create([
                'user_id' => $staffUsers->random()->id, // Pilih user staff secara acak
            ]);
        }
    }
}
