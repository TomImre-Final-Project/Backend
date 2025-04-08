<?php

namespace Database\Factories;

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
            'user_username' => \App\Models\User::factory()->create()->username,
            'restaurant_id' => \App\Models\Restaurant::factory(),
            'courier_username' => $this->faker->optional()->randomElement(\App\Models\User::where('role', 'courier')->pluck('username')->toArray()),
            'order_date' => now(),
            'status' => $this->faker->randomElement(['pending', 'in_delivery', 'delivered', 'cancelled']),
            'total_price' => $this->faker->numberBetween(0, 1000000),
            'picked_up_at' => $this->faker->optional()->dateTime(),
            'delivered_at' => $this->faker->optional()->dateTime(),
            'special_instructions' => $this->faker->optional()->text(100),
        ];
    }
}
