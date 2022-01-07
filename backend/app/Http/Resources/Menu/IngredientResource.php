<?php

namespace App\Http\Resources\Menu;

use Illuminate\Http\Resources\Json\JsonResource;

class IngredientResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'serving_type' => $this->serving_type,
            'allergens' => AllergenResource::collection($this->allergens)
        ];
    }
}
