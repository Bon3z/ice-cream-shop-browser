<?php

namespace Tests\Feature;

use Database\Factories\IceCreamShopFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    private array $data = [
        'credentials' =>[
            'email' => 'test@example.com',
            'name' => 'Shop name',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ],
        'shop' => [
            'city' => 'City',
            'name' => 'Profile name',
            'description' => 'Shop description',
            'street_name' => 'Street',
            'street_number' => 12,
            'unit_number' => 3,
            'postal' => '00-000',
            'phone' => '1234567890',
            'latitude' => '123',
            'longitude' => '321'
        ]
    ];

    public function test_guest_attempts_to_register_with_correct_credentials(): void
    {
        $response = $this->post('/api/register', $this->data);

        $response->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseCount('ice_cream_shops', 1);
    }

    public function test_guest_attempts_to_register_with_incorrect_data(): void
    {
        $this->data['credentials']['password'] = 'password1234';

        $response = $this->post('/api/register', $this->data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_guest_attempts_to_register_with_existing_email(): void
    {
        $email = 'test@example.com';

        IceCreamShopFactory::new()->create(['email' => $email]);

        $response = $this->post('/api/register', $this->data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
