<?php

namespace App\Http\Resources\Menu;

use Illuminate\Http\Resources\Json\JsonResource;

class IngredientResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'servingType' => $this->serving_type,
            'price' => $this->price,
            'allergens' => AllergenResource::collection($this->allergens)
        ];
    }
}
