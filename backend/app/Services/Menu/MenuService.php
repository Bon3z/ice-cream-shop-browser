<?php

namespace App\Services\Menu;

use App\Models\IceCreamShopProfile;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection;

class MenuService implements MenuServiceInterface
{
    public function create(IceCreamShopProfile $profile, array $data): void
    {
        $menu = $profile->menu()->create();

        $ingredient = $menu->ingredient()->create($data["ingredient"]);

        if (isset($data["allergen"])) {
            $ingredient->allergens()->create($data["allergen"]);
        }
    }

    public function getMenu(IceCreamShopProfile $profile): Collection
    {
        return $profile->menuIngredients()->get();
    }

    public function delete(Menu $menu): void
    {
        $menu->delete();
    }
}
