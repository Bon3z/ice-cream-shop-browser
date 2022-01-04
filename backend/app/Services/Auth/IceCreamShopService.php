<?php

namespace App\Services\Auth;

use App\Exceptions\AccountNotActivatedException;
use App\Models\IceCreamShop;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Hashing\Hasher;

class IceCreamShopService implements IceCreamShopServiceInterface
{
    protected IceCreamShop $shop;
    protected Hasher $hashes;

    public function __construct(IceCreamShop $shop, Hasher $hashes)
    {
        $this->shop = $shop;
        $this->hashes = $hashes;
    }

    public function register(array $data): int
    {
        $data["password"] = $this->hashes->make($data["password"]);
        return $this->shop->create($data)->id;
    }

    /**
     * @throws AuthenticationException
     * @throws AccountNotActivatedException
     */
    public function login(array $credentials): string
    {
        $shop = $this->shop->query()->where("email", $credentials["email"])->first();

        if (!$shop || !$this->hashes->check($credentials["password"], $shop["password"])) {
            throw new AuthenticationException("Incorrect credentials.");
        }

        if (!$shop["accepted"])
        {
            throw new AccountNotActivatedException("Shop has not been approved yet!");
        }

        return $shop->createToken($shop->email)->plainTextToken;
    }
}
