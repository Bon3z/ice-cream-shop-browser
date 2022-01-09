<?php

namespace App\Http\Resources\Menu;

use Illuminate\Http\Resources\Json\JsonResource;

class AllergenResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description
        ];
    }
}
