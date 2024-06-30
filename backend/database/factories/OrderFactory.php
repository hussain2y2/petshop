<?php

namespace Database\Factories;

use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'order_status_id' => OrderStatus::factory(),
            'payment_id' => Payment::factory(),
            'uuid' => $this->faker->uuid(),
            'products' => [
                'product' => $this->faker->randomElement(Product::pluck('uuid')),
                'quantity' => $this->faker->numberBetween(1, 7)
            ],
            'address' => [
                'billing' => $this->faker->address(),
                'shipping' => $this->faker->address(),
            ],
            'delivery_fee' => $this->faker->randomFloat(2, 10),
            'amount' => $this->faker->randomFloat(2, 10),
        ];
    }
}
