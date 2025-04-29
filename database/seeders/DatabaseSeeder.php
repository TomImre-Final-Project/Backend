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
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create random users if none exist
        if (User::count() === 0) {
            User::factory(10)->create();
        }

        // Create admin user if it doesn't exist
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

        // Create courier user if it doesn't exist
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

        // Create restaurant manager user if it doesn't exist
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

        // Create restaurants if none exist
        if (Restaurant::count() === 0) {
            Restaurant::factory(10)->create();
        }
        
        // Create categories if none exist
        if (Category::count() === 0) {
            Category::factory(10)->create();
        }
        
        // Create dishes if none exist
        if (Dish::count() === 0) {
            Dish::factory(100)->create();
        }

        // Create example restaurants if they don't exist
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

        // Add dishes to the first restaurant
       /* $restaurant1->dishes()->createMany([
            [
                'name' => 'Gulyásleves',
                'description' => 'Hagyományos magyar gulyásleves',
                'price' => 2500
            ],
            [
                'name' => 'Rántott szelet',
                'description' => 'Rántott sertésszelet hasábburgonyával',
                'price' => 3200
            ]
        ]);

        // Add dishes to the second restaurant
        $restaurant2->dishes()->createMany([
            [
                'name' => 'Pizza Margherita',
                'description' => 'Paradicsomos alap, mozzarella, bazsalikom',
                'price' => 2800
            ],
            [
                'name' => 'Spagetti Carbonara',
                'description' => 'Tojásos-sajtos spagetti szalonnával',
                'price' => 2900
            ]
        ]);*/
    }
}
