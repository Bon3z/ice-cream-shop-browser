<?php

namespace Database\Factories;

use App\Models\IceCreamShop;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    protected $model = IceCreamShop::class;

    public function definition(): array
    {
        $hash = app(Hasher::class);

        return [
            'email' => $this->faker->unique()->safeEmail,
            'name' => $this->faker->text(10),
            'accepted' => now(),
            'password' => $hash->make('password'),
        ];
    }
}
