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
            'customer_id' => Customer::factory(), // Assuming Customer has a factory
            'user_id' => User::factory(), // Assuming User has a factory
            'sales_date' => now(), // Current date and time
            'total_amount' => fake()->randomFloat(0, 300000, 10000000), // Random amount between 100 and 10,000
            'down_payment' => fake()->randomFloat(0, 300000, 10000000), // Random down payment between 50 and 5,000
            'remaining_payment' => fake()->optional()->randomFloat(2, 0, 5000), // Optional remaining payment
            'payment_status' => fake()->randomElement(['0', '1']), // Random payment status
        ];
    }
}
