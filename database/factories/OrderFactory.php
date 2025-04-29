<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


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
            'user_id' => \App\Models\User::factory(),
            'restaurant_id' => \App\Models\Restaurant::factory(),
            'courier_id' => $this->faker->optional()->randomElement(\App\Models\User::where('role', 'courier')->pluck('id')->toArray()),
            'order_date' => now(),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'preparing', 'ready', 'delivering', 'delivered', 'cancelled']),
            'total_price' => $this->faker->numberBetween(0, 1000000),
            'picked_up_at' => $this->faker->optional()->dateTime(),
            'delivered_at' => $this->faker->optional()->dateTime(),
            'special_instructions' => $this->faker->optional()->text(100),
        ];
    }
}
