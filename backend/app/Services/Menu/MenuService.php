<?php

namespace App\Services\Menu;

use App\Models\IceCreamShopProfile;

class MenuService implements MenuServiceInterface
{
    public function create(IceCreamShopProfile $profile, array $data): void
    {
        $menu = $profile->menu()->create();
        foreach ($data as $key => $ingredient) {
            $menu->ingredients()->create($ingredient);
        }
    }
}
