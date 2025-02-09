<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static $noteNumber = 1;
    public function definition(): array
    {
        return [
            //
            'note_number' => str_pad(static::$noteNumber++, 9, '0', STR_PAD_LEFT),
            'customer_id' => Customer::factory(),
            'user_id' => User::factory(),
            'sales_date' => now(),
            'total_amount' => fake()->randomFloat(0, 3000000, 10000000),
            'discount' => fake()->randomFloat(0, 300000, 500000),
            'down_payment' => fake()->randomFloat(0, 300000, 10000000),
            'payment_status' => fake()->randomElement(['pending', 'paid']),
        ];
    }
}
