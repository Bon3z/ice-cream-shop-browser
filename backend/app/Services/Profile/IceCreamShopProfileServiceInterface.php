<?php

namespace App\Services\Profile;

use App\Models\IceCreamShopProfile;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface IceCreamShopProfileServiceInterface
{
    public function create(array $shop, int $shopId): int;
    public function update(array $shop, IceCreamShopProfile $profile): int;
    public function getAll(int $perPage): LengthAwarePaginator;
    public function indexByCity(string $city, int $perPage): LengthAwarePaginator;
    public function indexByShopId(int $shopId, int $perPage): LengthAwarePaginator;
    public function show(int $profileId): ?IceCreamShopProfile;
    public function delete(int $profileId): void;
}
