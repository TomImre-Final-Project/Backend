<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderStatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function manager_can_only_set_pending_confirmed_ready()
    {
        $manager = User::factory()->create(['role' => 'restaurant_manager']);
        $restaurant = Restaurant::factory()->create(['manager_id' => $manager->id]);
        $order = Order::factory()->create(['restaurant_id' => $restaurant->id, 'status' => 'pending']);

        $this->actingAs($manager);

        $allowed = ['pending', 'confirmed', 'ready'];
        foreach ($allowed as $status) {
            $response = $this->putJson("/api/restaurantmanager/orders/{$order->id}", [
                'status' => $status,
                'total_price' => $order->total_price,
            ]);
            $response->assertStatus(200);
        }

        $notAllowed = ['preparing', 'delivering', 'delivered', 'cancelled'];
        foreach ($notAllowed as $status) {
            $response = $this->putJson("/api/restaurantmanager/orders/{$order->id}", [
                'status' => $status,
                'total_price' => $order->total_price,
            ]);
            $response->assertStatus(422);
        }
    }
} 