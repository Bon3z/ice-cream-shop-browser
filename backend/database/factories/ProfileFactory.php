<?php

namespace Database\Factories;

use App\Models\IceCreamShopProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    protected $model = IceCreamShopProfile::class;

    public function definition(): array
    {
        return [
            'city' => $this->faker->city,
            'name' => $this->faker->name,
            'description' => $this->faker->text(20),
            'street_name' => $this->faker->streetName,
            'street_number' => $this->faker->numberBetween(0, 20),
            'unit_number' => $this->faker->numberBetween(0, 50),
            'postal' => $this->faker->postcode,
            'phone' => $this->faker->phoneNumber,
            'latitude' => $this->faker->numberBetween(0, 100),
            'longitude' => $this->faker->numberBetween(0, 100)
        ];
    }
}
