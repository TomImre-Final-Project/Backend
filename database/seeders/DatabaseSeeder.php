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
        User::factory(10)->create();

        User::create([
            'username' => 'adminuser',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone' => '1234567890',
            'address' => 'Admin Address',
        ]);

        Restaurant::factory(10)->create();
        Category::factory(10)->create();
        Dish::factory(100)->create();

        // Create a few restaurants
        $restaurant1 = Restaurant::create([
            'name' => 'Példa Étterem',
            'address' => 'Budapest, Példa utca 1.',
            'phone' => '+36 1 234 5678'
        ]);

        $restaurant2 = Restaurant::create([
            'name' => 'Másik Étterem',
            'address' => 'Budapest, Másik utca 2.',
            'phone' => '+36 1 234 5679'
        ]);

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
