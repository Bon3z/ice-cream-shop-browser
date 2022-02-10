<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    public function render($request, Throwable $e): JsonResponse
    {
        if ($e instanceof AuthenticationException)
        {
            return $this->renderJsonResponse($e->getMessage(), Response::HTTP_UNAUTHORIZED);
        }

        if ($e instanceof AccountNotActivatedException)
        {
            return $this->renderJsonResponse($e->getMessage(), $e->getCode());
        }

        if ($e instanceof ValidationException) {
            return $this->renderJsonResponse($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY, $e->errors());
        }

        if ($e instanceof ModelNotFoundException || $e instanceof RouteNotFoundException || $e instanceof NotFoundHttpException) {
            return $this->renderJsonResponse("Not found", Response::HTTP_NOT_FOUND);
        }

        return $this->renderJsonResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    private function renderJsonResponse(string $message, int $code, array $data = []): JsonResponse
    {
        return response()->json([
            'message' => $message,
            "data" => $data
        ], $code);
    }
}
