<?php

namespace App\Services\Auth;

use App\Models\IceCreamShop;
use App\Models\IceCreamShopProfile;

interface IceCreamShopServiceInterface
{
    public function register(array $data): int;
    public function login(array $credentials): string;
    public function delete(IceCreamShop $shop): void;
}
