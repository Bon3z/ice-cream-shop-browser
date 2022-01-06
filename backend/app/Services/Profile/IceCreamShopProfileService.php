<?php

namespace App\Services\Profile;

use App\Models\IceCreamShop;
use App\Models\IceCreamShopProfile;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class IceCreamShopProfileService implements IceCreamShopProfileServiceInterface
{
    protected IceCreamShop $shop;
    protected IceCreamShopProfile $profile;

    public function __construct(IceCreamShop $shop, IceCreamShopProfile $profile)
    {
        $this->shop = $shop;
        $this->profile = $profile;
    }

    public function create(array $shop, int $shopId): int
    {
        return $this->getShop($shopId)->first()->profiles()->create($shop)->id;
    }

    public function update(array $shop, IceCreamShopProfile $profile): int
    {
        $profile->update($shop);
        return $profile->id;
    }

    public function getAll(int $perPage): LengthAwarePaginator
    {
        return $this->shop->paginate($perPage);
    }

    public function indexByCity(string $city, int $perPage): LengthAwarePaginator
    {
        return $this->getProfile('city', $city)->paginate($perPage);
    }

    public function indexByShopId(int $shopId, int $perPage): LengthAwarePaginator
    {
        return $this->getProfile('ice_cream_shop_id', $shopId)->paginate($perPage);
    }

    public function show(int $profileId): ?IceCreamShopProfile
    {
        return $this->getProfile('id', $profileId)->first();
    }

    private function getProfile(string $column, string | int $value): Builder
    {
        return $this->profile->query()->where($column, $value);
    }

    private function getShop(int $id): Builder
    {
        return $this->shop->query()->where('id', $id);
    }
}
