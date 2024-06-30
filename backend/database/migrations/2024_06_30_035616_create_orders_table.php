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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('order_status_id')->constrained('order_status');
            $table->foreignId('payment_id')->constrained('payments');
            $table->uuid()->unique();
            $table->json('products')->comment('Array of {"product":"uuid","quantity":"int"}');
            $table->json('address')->comment('Object of billing and shipping address');
            $table->float('delivery_fee', 8)->nullable();
            $table->float('amount', 8)->nullable();
            $table->timestamps();
            $table->timestamp('shipped_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
