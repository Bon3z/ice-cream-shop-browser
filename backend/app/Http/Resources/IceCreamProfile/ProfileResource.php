<?php

namespace App\Http\Resources\IceCreamProfile;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'city' => $this->city,
            'phone' => $this->phone,
            'description' => $this->description,
            'street_name' => $this->street_name,
            'street_number' => $this->street_number,
            'unit_number' => $this->unit_number,
            'postal' => $this->postal,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
