<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Dish;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Category;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class OrderTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create test categories
        Category::factory()->count(3)->create();
    }

    #[Test]
    public function customer_can_create_order()
    {
        // Create test customer, restaurant, and dish
        $customer = User::factory()->create(['role' => 'customer']);
        $restaurant = Restaurant::factory()->create(['status' => 'active']);
        $dish = Dish::factory()->create(['restaurant_id' => $restaurant->id, 'is_available' => true]);

        // Authenticate as customer
        Sanctum::actingAs($customer, ['*']);

        $response = $this->postJson('/api/orders', [
            'restaurant_id' => $restaurant->id,
            'items' => [
                [
                    'dish_id' => $dish->id,
                    'quantity' => 2
                ]
            ],
            'special_instructions' => 'No onions please'
        ]);

        $response->assertStatus(201)
                ->assertJsonStructure([
                    'message',
                    'order' => [
                        'id',
                        'user_id',
                        'restaurant_id',
                        'status',
                        'total_price'
                    ]
                ]);

        $this->assertDatabaseHas('orders', [
            'user_id' => $customer->id,
            'restaurant_id' => $restaurant->id,
            'status' => 'pending'
        ]);
    }

    #[Test]
    public function restaurant_manager_can_update_order_status()
    {
        // Create test manager, restaurant, and order
        $manager = User::factory()->create(['role' => 'restaurant_manager']);
        $restaurant = Restaurant::factory()->create(['manager_id' => $manager->id]);
        $order = Order::factory()->create([
            'restaurant_id' => $restaurant->id,
            'status' => 'pending'
        ]);

        // Authenticate as manager
        Sanctum::actingAs($manager, ['*']);

        $response = $this->putJson("/api/restaurantmanager/orders/{$order->id}", [
            'status' => 'confirmed'
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'message' => 'Order updated successfully'
                ]);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'confirmed'
        ]);
    }

    #[Test]
    public function courier_can_accept_order()
    {
        // Create test courier and order
        $courier = User::factory()->create(['role' => 'courier']);
        $order = Order::factory()->create([
            'status' => 'ready',
            'courier_id' => null
        ]);

        // Authenticate as courier
        Sanctum::actingAs($courier, ['*']);

        $response = $this->postJson("/api/courier/accept-order/{$order->id}");

        $response->assertStatus(200)
                ->assertJson([
                    'message' => 'Order accepted successfully'
                ]);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'courier_id' => $courier->id,
            'status' => 'delivering'
        ]);
    }

    #[Test]
    public function courier_can_mark_order_as_delivered()
    {
        // Create test courier and order
        $courier = User::factory()->create(['role' => 'courier']);
        $order = Order::factory()->create([
            'status' => 'delivering',
            'courier_id' => $courier->id
        ]);

        // Authenticate as courier
        Sanctum::actingAs($courier, ['*']);

        $response = $this->postJson("/api/courier/mark-delivered/{$order->id}");

        $response->assertStatus(200)
                ->assertJson([
                    'message' => 'Order marked as delivered successfully'
                ]);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'delivered'
        ]);
    }

    #[Test]
    public function admin_can_list_all_orders()
    {
        // Create test admin and orders
        $admin = User::factory()->create(['role' => 'admin']);
        Order::factory()->count(5)->create();

        // Authenticate as admin
        Sanctum::actingAs($admin, ['*']);

        $response = $this->getJson('/api/admin/orders');

        $response->assertStatus(200)
                ->assertJsonCount(5);
    }
} 