<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;

class UserTest extends TestCase
{
    #[Test]
    public function it_checks_if_user_is_restaurant_manager()
    {
        $user = User::factory()->create(['role' => 'restaurant_manager']);
        $this->assertTrue($user->isRestaurantManager());
        $this->assertFalse($user->isCustomer());
        $this->assertFalse($user->isCourier());
        $this->assertFalse($user->isAdmin());
    }

    #[Test]
    public function it_checks_if_user_is_customer()
    {
        $user = User::factory()->create(['role' => 'customer']);
        $this->assertTrue($user->isCustomer());
        $this->assertFalse($user->isRestaurantManager());
        $this->assertFalse($user->isCourier());
        $this->assertFalse($user->isAdmin());
    }

    #[Test]
    public function it_checks_if_user_is_courier()
    {
        $user = User::factory()->create(['role' => 'courier']);
        $this->assertTrue($user->isCourier());
        $this->assertFalse($user->isRestaurantManager());
        $this->assertFalse($user->isCustomer());
        $this->assertFalse($user->isAdmin());
    }

    #[Test]
    public function it_checks_if_user_is_admin()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->assertTrue($user->isAdmin());
        $this->assertFalse($user->isRestaurantManager());
        $this->assertFalse($user->isCustomer());
        $this->assertFalse($user->isCourier());
    }
} 