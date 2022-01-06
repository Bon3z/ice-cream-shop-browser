<?php

namespace App\Http\Resources\IceCreamShop;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ShopCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            "shops" => ShopResource::collection($this->collection),
        ];
    }
}
