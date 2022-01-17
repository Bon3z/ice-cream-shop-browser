<?php

namespace App\Http\Resources\Options;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->city
        ];
    }
}
