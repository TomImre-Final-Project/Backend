<?php

namespace Database\Factories;

use App\Models\Restaurant;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;


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
            'restaurant_id' => Restaurant::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'price' => $this->faker->numberBetween(1000, 10000),
            'ingredients' => $this->faker->sentence,
            'is_available' => $this->faker->boolean,
            'image' => $this->faker->optional()->imageUrl(),
            'created_at' => now(),
        ];
    }
}
