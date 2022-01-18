<?php

declare(strict_types=1);

namespace App\Http\Resources\BasicPagination;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PaginatedCollection extends ResourceCollection
{
    protected function getPaginationLinks($request): array
    {
        return [
            "total" => $this->total(),
            "count" => $this->count(),
            "per_page" => $this->perPage(),
            "current_page" => $this->currentPage(),
            "total_pages" => $this->lastPage(),
        ];
    }
}
