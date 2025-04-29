<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /** @test */
    public function it_checks_if_user_is_restaurant_manager()
    {
        $user = new User(['role' => 'restaurant_manager']);
        $this->assertTrue($user->isRestaurantManager());
        $this->assertFalse($user->isCustomer());
        $this->assertFalse($user->isCourier());
        $this->assertFalse($user->isAdmin());
    }

    /** @test */
    public function it_checks_if_user_is_customer()
    {
        $user = new User(['role' => 'customer']);
        $this->assertTrue($user->isCustomer());
        $this->assertFalse($user->isRestaurantManager());
        $this->assertFalse($user->isCourier());
        $this->assertFalse($user->isAdmin());
    }

    /** @test */
    public function it_checks_if_user_is_courier()
    {
        $user = new User(['role' => 'courier']);
        $this->assertTrue($user->isCourier());
        $this->assertFalse($user->isRestaurantManager());
        $this->assertFalse($user->isCustomer());
        $this->assertFalse($user->isAdmin());
    }

    /** @test */
    public function it_checks_if_user_is_admin()
    {
        $user = new User(['role' => 'admin']);
        $this->assertTrue($user->isAdmin());
        $this->assertFalse($user->isRestaurantManager());
        $this->assertFalse($user->isCustomer());
        $this->assertFalse($user->isCourier());
    }
} 