<?php

namespace App\Services\Profile;

use App\Models\IceCreamShop;
use App\Models\IceCreamShopProfile;
use App\Models\Ingredient;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class IceCreamShopProfileService implements IceCreamShopProfileServiceInterface
{
    protected IceCreamShop $shop;
    protected IceCreamShopProfile $profile;
    protected Ingredient $ingredient;

    public function __construct(IceCreamShop $shop, IceCreamShopProfile $profile, Ingredient $ingredient)
    {
        $this->shop = $shop;
        $this->profile = $profile;
        $this->ingredient = $ingredient;
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

    public function get(array $data): LengthAwarePaginator
    {
        $builder = IceCreamShopProfile::query();

        if (isset($data["ingredient"])) {
            $builder->byIngredients($data["ingredient"]);
        }

        if (isset($data["city"])) {
            $builder->byCity($data["city"]);
        }

        return $builder->paginate($data["perPage"]);
    }

    public function getOptions(): array
    {
        $options = [];
        $options["cities"] = $this->profile->select('city')->distinct()->get();
        $options["ingredients"] = $this->ingredient->select('name')->distinct()->get();

        return $options;
    }

    public function getAll(int $perPage): LengthAwarePaginator
    {
        return $this->shop->paginate($perPage);
    }

    public function authIndex(int $shopId): Collection
    {
        return $this->getShop($shopId)->first()->profiles()->get();
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

    public function delete(int $profileId): void
    {
        $this->getProfile('id', $profileId)->first()->delete();
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
