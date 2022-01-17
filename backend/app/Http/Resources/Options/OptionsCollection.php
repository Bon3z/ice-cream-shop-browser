<?php

namespace App\Http\Resources\Options;

use App\Http\Resources\Menu\IngredientResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OptionsCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            "options" => [
                "cities" => CityResource::collection($this->collection["cities"]),
                "ingredients" => IngredientResource::collection($this->collection["ingredients"])
            ]
        ];
    }
}
