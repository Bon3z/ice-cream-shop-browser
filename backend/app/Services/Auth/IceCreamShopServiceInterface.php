<?php

namespace App\Services\Auth;

interface IceCreamShopServiceInterface
{
    public function register(array $credentials): void;
    public function login(array $credentials): string;
}
