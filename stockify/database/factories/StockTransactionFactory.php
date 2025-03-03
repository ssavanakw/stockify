<?php

namespace Database\Factories;

use App\Models\StockTransaction;
use App\Models\Material;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class StockTransactionFactory extends Factory
{
    protected $model = StockTransaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'material_id' => Material::factory(),
            'user_id' => User::factory(),
            'quantity' => $this->faker->numberBetween(1, 50),
            'type' => $this->faker->randomElement(['in', 'out']),
            'date' => $this->faker->dateTimeThisYear(),
        ];
    }
}
