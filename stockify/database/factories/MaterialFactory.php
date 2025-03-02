<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    protected $model = Material::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->word,
            'price' => $this->faker->numberBetween(1000, 5000000),
            'stock' => $this->faker->randomNumber(),
            'category_id' => $this->faker->randomElement(Category::pluck('id')), // Assuming there are 10 categories
        ];
    }
}
