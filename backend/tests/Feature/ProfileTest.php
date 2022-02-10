<?php

namespace Tests\Feature;

use App\Models\IceCreamShop;
use Database\Factories\ShopFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_when_shop_is_created_profile_should_be_created()
    {
        /** @var IceCreamShop $shop */
        $shop = ShopFactory::new()->create();

        $this->assertTrue($shop->profiles()->exists());
    }

    public function test_guest_attempts_to_show_shop_any_profile()
    {
        /** @var IceCreamShop $shop */
        $shop = ShopFactory::new()->create();
        $createdProfileId = $shop->profiles()->first()->id;
        $response = $this->get("/api/shops/profile/$createdProfileId");

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_guest_attempts_to_show_non_existing_shop_profile()
    {
        /** @var IceCreamShop $shop */
        ShopFactory::new()->create();
        $response = $this->get('/api/shops/profile/100');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_user_attempts_to_update_profile_info()
    {
        $shop = ShopFactory::new()->create();
        $createdProfileId = $shop->profiles()->first()->id;

        $response = $this->actingAs($shop)->put("/api/shops/profile/$createdProfileId");

        $response->assertStatus(Response::HTTP_CREATED);
    }
}
