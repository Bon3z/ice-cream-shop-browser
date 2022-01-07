<?php

namespace App\Services\Menu;

use App\Models\IceCreamShopProfile;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection;

interface MenuServiceInterface
{
    public function create(IceCreamShopProfile $profile, array $data): void;
    public function getMenu(IceCreamShopProfile $profile): Collection;
    public function delete(Menu $menu): void;
}
