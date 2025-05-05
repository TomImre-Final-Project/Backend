<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Restaurant;
use PHPUnit\Framework\Attributes\Test;

class RestaurantTest extends TestCase
{
    #[Test]
    public function only_active_restaurants_are_returned()
    {
        // Create active and inactive restaurants
        Restaurant::factory()->count(3)->create(['status' => 'active']);
        Restaurant::factory()->count(2)->create(['status' => 'inactive']);

        $response = $this->getJson('/api/restaurants');

        $response->assertStatus(200)
                ->assertJsonCount(3); // Only active restaurants should be returned
    }
} 