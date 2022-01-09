<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
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
