<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Promotion>
 */
class PromotionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => strtoupper($this->faker->unique()->word),
            'description' => $this->faker->sentence,
            'discount_percentage' => $this->faker->randomFloat(2, 5, 50),
            'start_date' => now(),
            'end_date' => now()->addDays($this->faker->numberBetween(1, 30)),
            'is_active' => $this->faker->boolean(80),
        ];
    }
}
