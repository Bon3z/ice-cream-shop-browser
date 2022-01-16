<?php

namespace App\Http\Resources\Menu;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MenuCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            "id" => $this->collection[0]->menu_id,
            "menu" => IngredientResource::collection($this->collection),
        ];
    }
}
