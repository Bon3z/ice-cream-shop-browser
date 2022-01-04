<?php

namespace App\Http\Controllers;

use App\Http\Requests\IceCreamShopCreateProfileRequest;
use App\Http\Requests\IceCreamShopLoginRequest;
use App\Http\Requests\IceCreamShopRegisterRequest;
use App\Http\Requests\IceCreamShopUpdateRequest;
use App\Models\IceCreamShop;
use App\Models\IceCreamShopProfile;
use App\Services\Auth\IceCreamShopServiceInterface;
use App\Services\Profile\IceCreamShopProfileServiceInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class IceCreamShopController extends Controller
{
    protected IceCreamShopServiceInterface $shopService;
    protected IceCreamShopProfileServiceInterface $profileService;

    public function __construct(IceCreamShopServiceInterface $shopService, IceCreamShopProfileServiceInterface $profileService)
    {
        $this->shopService = $shopService;
        $this->profileService = $profileService;
    }

    public function register(IceCreamShopRegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $id = $this->shopService->register($validated["credentials"]);
        $this->profileService->create($validated["shop"], $id);

        return response()->json(
            'Request has been received! Await further instructions.',
            Response::HTTP_CREATED
        );
    }

    public function login(IceCreamShopLoginRequest $request): JsonResponse
    {
        $token = $this->shopService->login($request->validated());

        return response()->json(
            $token,
            Response::HTTP_OK
        );
    }
}
