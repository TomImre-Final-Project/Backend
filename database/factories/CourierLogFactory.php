<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class CourierLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'courier_username' => \App\Models\User::factory()->create(['role' => 'courier'])->username,
            'order_id' => \App\Models\Order::factory(),
            'action' => $this->faker->randomElement(['claimed', 'delivered']),
            'timestamp' => now(),
        ];
    }
}
