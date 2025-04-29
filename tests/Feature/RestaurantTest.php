<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RestaurantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_active_restaurants_are_returned()
    {
        Restaurant::factory()->create(['status' => 'active']);
        Restaurant::factory()->create(['status' => 'inactive']);

        $response = $this->getJson('/api/restaurants');

        $response->assertStatus(200);
        $this->assertCount(1, collect($response->json())->where('status', 'active'));
    }
} 