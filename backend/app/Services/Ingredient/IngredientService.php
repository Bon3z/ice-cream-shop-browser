<?php

namespace App\Services\Ingredient;

use App\Models\Ingredient;
use App\Models\Menu;

class IngredientService implements IngredientServiceInterface
{
    public function create(Menu $menu, array $data): void
    {
        $menu->ingredient()->create($data["ingredient"]);
    }

    public function update(Ingredient $ingredient, array $data): void
    {
        $ingredient->update($data["ingredient"]);

        if (isset($data["allergen"]))
        {
            $ingredient->allergens()->find($data["allergen"]["id"])->update($data["allergen"]);
        }
    }

    public function delete(Ingredient $ingredient): void
    {
        $ingredient->delete();
    }
}
