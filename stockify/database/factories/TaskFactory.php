<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3), // Contoh: "Angkat Barang"
            'description' => $this->faker->sentence(5), // Contoh: "5 Gajah"
            'status' => 'Pending', // Status default
            'user_id' => User::factory(), // Membuat user baru atau pakai yang sudah ada
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
