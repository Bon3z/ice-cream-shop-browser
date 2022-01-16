<?php

namespace App\Services\Allergen;

use App\Models\Allergen;
use App\Models\Ingredient;

class AllergenService implements AllergenServiceInterface
{
    public function create(Ingredient $ingredient, array $data): void
    {
        $ingredient->allergens()->create($data);
    }

    public function update(Allergen $allergen, array $data): void
    {
        $allergen->update($data);
    }

    public function delete(Allergen $allergen): void
    {
        $allergen->delete();
    }
}
