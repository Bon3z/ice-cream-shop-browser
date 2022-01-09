<?php

namespace App\Services\Ingredient;

use App\Models\Ingredient;
use App\Models\Menu;

interface IngredientServiceInterface
{
    public function create(Menu $menu, array $data): void;
    public function update(Ingredient $ingredient, array $data): void;
    public function delete(Ingredient $ingredient): void;
}
