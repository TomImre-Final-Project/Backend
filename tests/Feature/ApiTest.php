<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Dish;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class ApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create test categories
        Category::factory()->count(3)->create();
    }


    #[Test]
    public function it_can_get_all_restaurants()
    {
        // Create test restaurants
        Restaurant::factory()->count(3)->create();

        $response = $this->getJson('/api/restaurants');

        $response->assertStatus(200)
                ->assertJsonCount(3);
    }

    #[Test]
    public function it_can_get_restaurant_dishes()
    {
        // Create test restaurant and dishes
        $restaurant = Restaurant::factory()->create();
        Dish::factory()->count(3)->create(['restaurant_id' => $restaurant->id]);

        $response = $this->getJson("/api/restaurants/{$restaurant->id}/dishes");

        $response->assertStatus(200)
                ->assertJsonCount(3);
    }

    #[Test]
    public function restaurant_manager_can_create_dish()
    {
        // Create test manager and restaurant
        $manager = User::factory()->create(['role' => 'restaurant_manager']);
        $restaurant = Restaurant::factory()->create(['manager_id' => $manager->id]);
        $category = Category::first();

        // Authenticate as manager
        Sanctum::actingAs($manager, ['*']);

        $response = $this->postJson('/api/restaurantmanager/dishes', [
            'name' => 'Test Dish',
            'description' => 'Test Description',
            'price' => 1000,
            'category_id' => $category->id,
            'ingredients' => 'Test Ingredients',
            'is_available' => true
        ]);

        $response->assertStatus(201)
                ->assertJson([
                    'message' => 'Dish created successfully'
                ]);

        $this->assertDatabaseHas('dishes', [
            'name' => 'Test Dish',
            'restaurant_id' => $restaurant->id
        ]);
    }

    #[Test]
    public function restaurant_manager_can_update_dish()
    {
        // Create test manager, restaurant, and dish
        $manager = User::factory()->create(['role' => 'restaurant_manager']);
        $restaurant = Restaurant::factory()->create(['manager_id' => $manager->id]);
        $dish = Dish::factory()->create(['restaurant_id' => $restaurant->id]);

        // Authenticate as manager
        Sanctum::actingAs($manager, ['*']);

        $response = $this->putJson("/api/restaurantmanager/dishes/{$dish->id}", [
            'name' => 'Updated Dish',
            'description' => 'Updated Description',
            'price' => 2000,
            'category_id' => $dish->category_id,
            'ingredients' => 'Updated Ingredients',
            'is_available' => false
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'message' => 'Dish updated successfully'
                ]);

        $this->assertDatabaseHas('dishes', [
            'id' => $dish->id,
            'name' => 'Updated Dish',
            'is_available' => false
        ]);
    }

    #[Test]
    public function restaurant_manager_can_delete_dish()
    {
        // Create test manager, restaurant, and dish
        $manager = User::factory()->create(['role' => 'restaurant_manager']);
        $restaurant = Restaurant::factory()->create(['manager_id' => $manager->id]);
        $dish = Dish::factory()->create(['restaurant_id' => $restaurant->id]);

        // Authenticate as manager
        Sanctum::actingAs($manager, ['*']);

        $response = $this->deleteJson("/api/restaurantmanager/dishes/{$dish->id}");

        $response->assertStatus(200)
                ->assertJson([
                    'message' => 'Dish deleted successfully'
                ]);

        $this->assertDatabaseMissing('dishes', [
            'id' => $dish->id
        ]);
    }

    #[Test]
    public function restaurant_manager_can_get_their_restaurant()
    {
        // Create test manager and restaurant
        $manager = User::factory()->create(['role' => 'restaurant_manager']);
        $restaurant = Restaurant::factory()->create(['manager_id' => $manager->id]);

        // Authenticate as manager
        Sanctum::actingAs($manager, ['*']);

        $response = $this->getJson('/api/restaurantmanager/restaurant');

        $response->assertStatus(200)
                ->assertJson([
                    'id' => $restaurant->id,
                    'name' => $restaurant->name
                ]);
    }

    #[Test]
    public function restaurant_manager_can_update_their_restaurant()
    {
        // Create test manager and restaurant
        $manager = User::factory()->create(['role' => 'restaurant_manager']);
        $restaurant = Restaurant::factory()->create(['manager_id' => $manager->id]);

        // Authenticate as manager
        Sanctum::actingAs($manager, ['*']);

        $response = $this->putJson('/api/restaurantmanager/restaurant', [
            'name' => 'Updated Restaurant',
            'address' => 'Updated Address',
            'phone' => '1234567890',
            'status' => 'active'
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'message' => 'Restaurant updated successfully'
                ]);

        $this->assertDatabaseHas('restaurants', [
            'id' => $restaurant->id,
            'name' => 'Updated Restaurant'
        ]);
    }
} 