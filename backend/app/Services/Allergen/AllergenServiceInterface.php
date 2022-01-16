<?php

namespace App\Services\Allergen;

use App\Models\Allergen;
use App\Models\Ingredient;

interface AllergenServiceInterface
{
    public function create(Ingredient $ingredient, array $data): void;
    public function update(Allergen $allergen, array $data): void;
    public function delete(Allergen $allergen): void;
}
