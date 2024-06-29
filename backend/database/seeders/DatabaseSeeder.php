<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
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

         User::factory(10)->create();
         Brand::factory(11)->create();
        // Create 11 categories each with 11 products
         Category::factory()
            ->count(11)
            ->has(Product::factory()->count(11), 'products')
            ->create();
    }
}
