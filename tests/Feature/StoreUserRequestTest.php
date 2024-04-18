<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class StoreUserRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test submission of valid user data.
     *
     * @return void
     */
    public function testUserCreationWithValidData()
    {
        $response = $this->postJson('/api/users', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => '123 Apple St',
            'postal_code' => '12345',
            'city' => 'New York',
            'phone_number' => '1234567890',
            'email' => 'john.doe@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => '123 Apple St',
            'postal_code' => '12345',
            'city' => 'New York',
            'phone_number' => '1234567890',
            'email' => 'john.doe@example.com'
        ]);
    }

    /**
     * Test submission of invalid user data.
     *
     * @return void
     */
    public function testUserCreationWithInvalidData()
    {
        $response = $this->postJson('/api/users', [
            'first_name' => '',
            'last_name' => 'Doe',
            'address' => '123 Apple St',
            'postal_code' => '12345',
            'city' => 'New York',
            'phone_number' => '1234567890',
            'email' => 'not-an-email',
            'password' => '123',
            'password_confirmation' => '123',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['first_name', 'email', 'password']);
    }
}
