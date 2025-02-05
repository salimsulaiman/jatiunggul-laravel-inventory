<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $name = fake()->sentence(3, true);

        // Ambil kategori yang sudah ada di database secara acak
        $category = Category::inRandomOrder()->first() ?? Category::factory()->create();

        // Buat kode produk berdasarkan kategori
        $categoryCode = strtoupper(substr($category->name, 0, 3)); // 3 huruf pertama kategori
        $nameCode = strtoupper(substr(Str::slug($name, ''), 0, 4)); // 4 huruf pertama nama produk tanpa spasi
        $randomNumber = fake()->unique()->numberBetween(100, 999); // Nomor acak 3 digit

        return [
            'name' => $name,
            'description' => fake()->text(),
            'price' => fake()->randomFloat(0, 300000, 5000000),
            'stock' => fake()->numberBetween(0, 10),
            'category_id' => $category->id,
            'code' => "{$categoryCode}-{$nameCode}-{$randomNumber}",
        ];
    }
}
