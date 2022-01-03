<?php

namespace App\Services\Auth;

use App\Models\IceCreamShopProfile;

interface IceCreamShopServiceInterface
{
    public function register(array $data): int;
    public function login(array $credentials): string;
    public function create(array $shop, int $shopId): void;
    public function update(array $shop, IceCreamShopProfile $profile): void;
}
