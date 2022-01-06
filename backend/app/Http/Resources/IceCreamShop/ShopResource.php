<?php

namespace App\Http\Resources\IceCreamShop;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'email' => $this->email,
            'name' => $this->name
        ];
    }
}
