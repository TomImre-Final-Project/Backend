<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class RestaurantLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'restaurant_id' => \App\Models\Restaurant::factory(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'until' => $this->faker->optional()->date(),
        ];
    }
}
