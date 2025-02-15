<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('note_number', 9)->unique()->index();
            $table->foreignId('customer_id')->constrained(
                table: 'customers',
                indexName: 'sales_customer_id'
            );
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'sales_user_id'
            );
            $table->dateTime('sales_date')->now();
            $table->double('total_amount');
            $table->double('discount')->default(0);
            $table->double('down_payment')->default(0);
            $table->enum('payment_status', ['pending', 'paid'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
