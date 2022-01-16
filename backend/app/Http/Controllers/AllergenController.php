<?php

namespace App\Http\Controllers;

use App\Http\Requests\AllergenRequest;
use App\Models\Allergen;
use App\Models\Ingredient;
use App\Services\Allergen\AllergenServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AllergenController extends Controller
{
    protected AllergenServiceInterface $service;

    public function __construct(AllergenServiceInterface $service)
    {
        $this->service = $service;
    }

    public function create(Ingredient $ingredient, AllergenRequest $request): JsonResponse
    {
        $this->service->create($ingredient, $request->validated());

        return response()->json(null, Response::HTTP_CREATED);
    }

    public function update(Allergen $allergen, AllergenRequest $request): JsonResponse
    {
        $this->service->update($allergen, $request->validated());

        return response()->json(null, Response::HTTP_CREATED);
    }

    public function delete(Allergen $allergen): JsonResponse
    {
        $this->service->delete($allergen);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
