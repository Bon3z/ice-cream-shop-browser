<?php

namespace App\Http\Resources\IceCreamProfile;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProfileCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            "profiles" => ProfileResource::collection($this->collection),
        ];
    }
}
