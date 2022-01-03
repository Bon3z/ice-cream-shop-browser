<?php

namespace App\Http\Controllers;

use App\Exceptions\AccountNotActivatedException;
use App\Http\Requests\IceCreamShopLoginRequest;
use App\Http\Requests\IceCreamShopRegisterRequest;
use App\Services\Auth\IceCreamShopServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class IceCreamShopController extends Controller
{
    protected IceCreamShopServiceInterface $service;

    public function __construct(IceCreamShopServiceInterface $service)
    {
        $this->service = $service;
    }

    public function register(IceCreamShopRegisterRequest $request): JsonResponse
    {
        $this->service->register($request->validated());

        return response()->json(
            'Request has been received! Await further instructions.',
            Response::HTTP_CREATED
        );
    }

    public function login(IceCreamShopLoginRequest $request): JsonResponse
    {
        $token = $this->service->login($request->validated());

        return response()->json(
            $token,
            Response::HTTP_OK
        );
    }
}
