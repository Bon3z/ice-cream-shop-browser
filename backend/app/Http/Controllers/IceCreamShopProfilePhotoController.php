<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Http\Resources\Photo\PhotoCollection;
use App\Models\IceCreamShopProfile;
use App\Models\IceCreamShopProfilePhoto;
use App\Services\Photo\Profile\IceCreamShopProfilePhotoServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class IceCreamShopProfilePhotoController extends Controller
{
    protected IceCreamShopProfilePhotoServiceInterface $service;

    public function __construct(IceCreamShopProfilePhotoServiceInterface $service)
    {
        $this->service = $service;
    }

    public function create(PhotoRequest $request, IceCreamShopProfile $profile): JsonResponse
    {
        $this->service->upload($request->file('image'), $profile->id);

        return response()->json(null, Response::HTTP_CREATED);
    }

    public function show(IceCreamShopProfile $profile): JsonResponse
    {
        $photos = $this->service->getPhotos($profile);

        return response()->json(new PhotoCollection($photos), Response::HTTP_OK);
    }

    public function delete(IceCreamShopProfilePhoto $photo): JsonResponse
    {
        $this->service->delete($photo);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
