<?php

namespace App\Services\Menu;

use App\Models\IceCreamShopProfile;

interface MenuServiceInterface
{
    public function create(IceCreamShopProfile $profile, array $data): void;
}
