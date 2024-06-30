<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'uuid' => fake()->uuid(),
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@buckhill.co.uk',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'address' => fake()->address(),
            'phone_number' => fake()->phoneNumber(),
        ]);

        OrderStatus::factory(11)->create();
        Payment::factory(11)->create();
        Brand::factory(11)->create();
        // Create 11 categories each with 11 products
        Category::factory()
            ->count(11)
            ->has(Product::factory()->count(11), 'products')
            ->create();
        User::factory()
            ->count(10)
            ->has(Order::factory()->count(11), 'orders')
            ->create();
    }
}
