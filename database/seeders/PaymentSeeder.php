<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Sale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::factory(1)->recycle([
            Sale::all()
        ])->create();
    }
}
