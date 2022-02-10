<?php

declare(strict_types=1);

namespace Tests\Feature;

use Database\Factories\ShopFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_existing_user_attempts_to_login_with_correct_credentials(): void
    {
        $email = 'test@example.com';

        ShopFactory::new()->create(['email' => $email]);

        $response = $this->post('/api/login', [
            'email' => $email,
            'password' => 'password']
        );

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_user_attempts_to_login_with_incorrect_credentials(): void
    {
        $response = $this->post('/api/login', [
            'email' => 'wrongEmail@example.com',
            'password' => 'password'
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_user_attempts_to_login_without_credentials(): void
    {
        $response = $this->post('/api/login', []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
