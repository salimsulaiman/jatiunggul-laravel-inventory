<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => fake()->sentence(3, true),
            'description' => fake()->text(),
            'price' => fake()->randomFloat(0, 300000, 5000000),
            'stock' => fake()->numberBetween(0,10),
            'category_id' =>  Category::factory()
        ];
    }
}