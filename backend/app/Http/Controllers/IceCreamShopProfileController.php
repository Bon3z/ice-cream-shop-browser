<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilteredRequest;
use App\Http\Requests\IceCreamShopCreateProfileRequest;
use App\Http\Requests\IceCreamShopProfileRequest;
use App\Http\Resources\IceCreamProfile\ProfileCollection;
use App\Http\Resources\IceCreamProfile\ProfileResource;
use App\Http\Resources\Options\OptionsCollection;
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

    public function index(FilteredRequest $request): JsonResponse
    {
        $profiles = $this->service->get($request->validated());

        return response()->json(new ProfileCollection($profiles), Response::HTTP_OK);
    }

    public function authIndex(Request $request): JsonResponse
    {
        $profiles = $this->service->authIndex($request->user()->id);

        return response()->json(new ProfileCollection($profiles), Response::HTTP_OK);
    }

    public function create(IceCreamShopCreateProfileRequest $request): JsonResponse
    {
        $shopId = $this->service->create($request->validated(), $request->user()->id);

        return response()->json([
                'message' => 'Ice cream shop profile has been created!',
                'shopId' => $shopId
        ],Response::HTTP_CREATED);
    }

    public function update(IceCreamShopProfileRequest $request, IceCreamShopProfile $profile): JsonResponse
    {
        $shopId = $this->service->update($request->validated(), $profile);

        return response()->json([
            'message' => 'Shop has been updated!',
            'shopId' => $shopId
        ],Response::HTTP_CREATED);
    }

    public function options(): JsonResponse
    {
        $cities = $this->service->getOptions();

        return response()->json(new OptionsCollection($cities), Response::HTTP_OK);
    }

    public function indexByCity(Request $request): JsonResponse
    {
        $profiles = $this->service->indexByCity($request->city, $request->input('perPage'));

        return response()->json(new ProfileCollection($profiles), Response::HTTP_OK);
    }

    public function indexByShopId(Request $request): JsonResponse
    {
        $profiles = $this->service->indexByShopId($request->id, $request->input('perPage'));

        return response()->json(new ProfileCollection($profiles), Response::HTTP_OK);
    }

    public function show(IceCreamShopProfile $profile): JsonResponse
    {
        $profile = $this->service->show($profile->id);

        return response()->json(new ProfileResource($profile), Response::HTTP_OK);
    }

    public function delete(IceCreamShopProfile $profile): JsonResponse
    {
        $this->service->delete($profile->id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
