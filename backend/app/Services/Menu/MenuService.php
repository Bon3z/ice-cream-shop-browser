<?php

namespace App\Services\Menu;

use App\Models\IceCreamShopProfile;
use Illuminate\Database\Eloquent\Collection;

class MenuService implements MenuServiceInterface
{
    public function create(IceCreamShopProfile $profile, array $data): void
    {
        $menu = $profile->menu()->create();

        foreach ($data as $key => $ingredientData) {
            $ingredient = $menu->ingredient()->create($ingredientData["ingredient"]);

            if ($ingredientData["allergen"]) {
                $ingredient->allergens()->create($ingredientData["allergen"]);
            }
        }
    }

    public function getMenu(IceCreamShopProfile $profile): Collection
    {
        return $profile->menuIngredients()->get();
    }
}
