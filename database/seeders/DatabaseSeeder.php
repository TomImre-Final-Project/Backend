<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\Dish;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        if (User::count() === 0) {
            User::factory(10)->create();
        }

        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'username' => 'adminuser',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'phone' => '1234567890',
                'address' => 'Admin Address',
            ]);
        }

        if (!User::where('email', 'courier@example.com')->exists()) {
            User::create([
                'username' => 'courieruser',
                'email' => 'courier@example.com',
                'password' => Hash::make('password123'),
                'role' => 'courier',
                'phone' => '1234567891',
                'address' => 'Courier Address',
            ]);
        }
        if (!User::where('email', 'restaurantmanager@example.com')->exists()) {
            User::create([
                'username' => 'restaurantmanager',
                'email' => 'restaurantmanager@example.com',
                'password' => Hash::make('password123'),
                'role' => 'restaurant_manager',
                'phone' => '1234567892',
                'address' => 'Restaurant Manager Address',
            ]);
        }

        if (Restaurant::count() === 0) {
            Restaurant::factory(10)->create();
        }
        
        if (Category::count() === 0) {
            Category::factory(10)->create();
        }
        
        if (Dish::count() === 0) {
            Dish::factory(100)->create();
        }

        if (!Restaurant::where('name', 'Példa Étterem')->exists()) {
            $restaurant1 = Restaurant::create([
                'name' => 'Példa Étterem',
                'address' => 'Budapest, Példa utca 1.',
                'phone' => '+36 1 234 5678'
            ]);
        }

        if (!Restaurant::where('name', 'Másik Étterem')->exists()) {
            $restaurant2 = Restaurant::create([
                'name' => 'Másik Étterem',
                'address' => 'Budapest, Másik utca 2.',
                'phone' => '+36 1 234 5679'
            ]);
        }


    }
}
