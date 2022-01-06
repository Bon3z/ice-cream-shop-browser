<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Models\IceCreamShopProfile;
use App\Services\Menu\MenuServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends Controller
{
    protected MenuServiceInterface $service;

    public function __construct(MenuServiceInterface $service)
    {
        $this->service = $service;
    }

    public function create(IceCreamShopProfile $profile, MenuRequest $request): JsonResponse
    {
        $this->service->create($profile, $request->validated());

        return response()->json(null, Response::HTTP_CREATED);
    }
}
