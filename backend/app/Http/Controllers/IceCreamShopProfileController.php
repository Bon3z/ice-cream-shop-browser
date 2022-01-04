<?php

namespace App\Http\Controllers;

use App\Http\Requests\IceCreamShopCreateProfileRequest;
use App\Http\Requests\IceCreamShopUpdateRequest;
use App\Models\IceCreamShopProfile;
use App\Services\Profile\IceCreamShopProfileServiceInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class IceCreamShopProfileController extends Controller
{
    protected IceCreamShopProfileServiceInterface $service;

    public function __construct(IceCreamShopProfileServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): JsonResponse
    {
        $profiles = $this->service->getAll($request->input('perPage'));

        return response()->json($profiles, Response::HTTP_OK);
    }

    public function create(IceCreamShopCreateProfileRequest $request): JsonResponse
    {
        $shopId = $this->service->create($request->validated(), $request->user()->id);

        return response()->json([
                'message' => 'Ice cream shop profile has been created!',
                'shopId' => $shopId
        ],Response::HTTP_CREATED);
    }

    public function update(IceCreamShopUpdateRequest $request, IceCreamShopProfile $profile): JsonResponse
    {
        $shopId = $this->service->update($request->validated(), $profile);

        return response()->json([
            'message' => 'Shop has been updated!',
            'shopId' => $shopId
        ],Response::HTTP_CREATED);
    }

    public function indexByCity(Request $request): JsonResponse
    {
        $profiles = $this->service->indexByCity($request->city, $request->input('perPage'));

        return response()->json($profiles, Response::HTTP_OK);
    }

    public function indexByShopId(Request $request): JsonResponse
    {
        $profiles = $this->service->indexByShopId($request->id, $request->input('perPage'));

        return response()->json($profiles, Response::HTTP_OK);
    }

    public function show(IceCreamShopProfile $profile): JsonResponse
    {
        $profile = $this->service->show($profile->id);

        return response()->json($profile, Response::HTTP_OK);
    }
}
