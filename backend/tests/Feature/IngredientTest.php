<?php

namespace Tests\Feature;

use App\Models\IceCreamShopProfile;
use Database\Factories\ProfileFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IngredientTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_attempts_to_add_ingredient(): void
    {

        $this->assertTrue(true);
    }
}
