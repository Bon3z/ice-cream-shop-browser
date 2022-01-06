<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Http\Resources\PhotoCollection;
use App\Models\IceCreamShopPhoto;
use App\Services\Photo\Shop\IceCreamShopPhotoServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IceCreamShopPhotoController extends Controller
{
    protected IceCreamShopPhotoServiceInterface $service;

    public function __construct(IceCreamShopPhotoServiceInterface $service)
    {
        $this->service = $service;
    }

    public function create(PhotoRequest $request): JsonResponse
    {
        $this->service->upload($request->file('image'), $request->user()->id);

        return response()->json(null, Response::HTTP_CREATED);
    }

    public function show(Request $request): JsonResponse
    {
        $photos = $this->service->getShopPhotos($request->user());

        return response()->json(new PhotoCollection($photos), Response::HTTP_OK);
    }

    public function delete(IceCreamShopPhoto $photo): JsonResponse
    {
        $this->service->delete($photo);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
