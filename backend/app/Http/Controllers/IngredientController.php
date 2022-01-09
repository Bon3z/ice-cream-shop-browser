<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientRequest;
use App\Http\Requests\MenuRequest;
use App\Models\Ingredient;
use App\Models\Menu;
use App\Services\Ingredient\IngredientServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class IngredientController extends Controller
{
    protected IngredientServiceInterface $service;

    public function __construct(IngredientServiceInterface $service)
    {
        $this->service = $service;
    }

    public function create(Menu $menu, MenuRequest $request): JsonResponse
    {
        $this->service->create($menu, $request->validated());

        return response()->json(null, Response::HTTP_CREATED);
    }

    public function update(Ingredient $ingredient, IngredientRequest $request): JsonResponse
    {
        $this->service->update($ingredient, $request->validated());

        return response()->json(null, Response::HTTP_CREATED);
    }

    public function delete(Ingredient $ingredient): JsonResponse
    {
        $this->service->delete($ingredient);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
