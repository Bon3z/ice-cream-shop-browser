<?php

namespace App\Http\Controllers;

use App\Http\Requests\IceCreamShopCreateProfileRequest;
use App\Http\Requests\IceCreamShopLoginRequest;
use App\Http\Requests\IceCreamShopRegisterRequest;
use App\Http\Requests\IceCreamShopUpdateRequest;
use App\Models\IceCreamShop;
use App\Models\IceCreamShopProfile;
use App\Services\Auth\IceCreamShopServiceInterface;
use Illuminate\Http\Request;
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
        $validated = $request->validated();
        $id = $this->service->register($validated["credentials"]);
        $this->service->create($validated["shop"], $id);

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

    public function create(IceCreamShopCreateProfileRequest $request): JsonResponse
    {
        $this->service->create($request->validated(), $request->user()->id);

        return response()->json(
            'Request has been received! Await approval.',
            Response::HTTP_CREATED
        );
    }

    public function update(IceCreamShopUpdateRequest $request, IceCreamShopProfile $profile): JsonResponse
    {
        $this->service->update($request->validated(), $profile);

        return response()->json(
            'Shop has been updated!',
            Response::HTTP_CREATED
        );
    }
}
