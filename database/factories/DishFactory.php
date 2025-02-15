<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dish>
 */
class DishFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'restaurant_id' => \App\Models\Restaurant::factory(),
            'price' => $this->faker->randomFloat(2, 5, 100),
            'category_id' => \App\Models\Category::factory(),
            'ingredients' => $this->faker->sentence,
            'is_available' => $this->faker->boolean,
            'image' => $this->faker->optional()->imageUrl(),
            'created_at' => now(),
        ];
    }
}
