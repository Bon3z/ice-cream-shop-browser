<?php

namespace App\Http\Resources\IceCreamProfile;

use App\Http\Resources\BasicPagination\PaginatedCollection;

class ProfileCollection extends PaginatedCollection
{
    public function toArray($request): array
    {
        return [
            "profiles" => ProfileResource::collection($this->collection),
            "pagination" => $this->getPaginationLinks($request),
        ];
    }
}
