<?php

namespace App\Services\Menu;

use App\Models\IceCreamShopProfile;
use Illuminate\Database\Eloquent\Collection;

class MenuService implements MenuServiceInterface
{
    public function create(IceCreamShopProfile $profile, array $data): void
    {
        $menu = $profile->menu()->create();
        foreach ($data as $key => $ingredient) {
            $menu->ingredient()->create($ingredient);
        }
    }

    public function getMenu(IceCreamShopProfile $profile): Collection
    {
        return $profile->menuIngredients()->get();
    }
}
