<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'username' => 'Test User2',
            'email' => 'testtest@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'customer',
            'phone' => '06302582582',
        ]);

        $this->assertAuthenticated();
        $response->assertNoContent();
    }
}
