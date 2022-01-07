<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Http\Resources\Menu\MenuCollection;
use App\Models\IceCreamShopProfile;
use App\Models\Menu;
use App\Services\Menu\MenuServiceInterface;
use Illuminate\Http\JsonResponse;
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

    public function index(IceCreamShopProfile $profile): JsonResponse
    {
        $ingredients = $this->service->getMenu($profile);

        return response()->json(new MenuCollection($ingredients), Response::HTTP_OK);
    }

    public function delete(Menu $menu): JsonResponse
    {
        $this->service->delete($menu);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
