<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Disable exception handling to see actual errors
        $this->withoutExceptionHandling();
        
        // Create a test user for authentication
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user, ['*']);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
