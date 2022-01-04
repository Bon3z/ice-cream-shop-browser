<?php

use App\Http\Controllers\IceCreamShopController;
use App\Http\Controllers\IceCreamShopProfileController;
use Illuminate\Routing\Router;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$router = app(Router::class);

$router->post('/register', [IceCreamShopController::class, 'register']);
$router->post('/login', [IceCreamShopController::class, 'login']);

$router->get('/shops/city/{city}', [IceCreamShopProfileController::class, 'indexByCity']);
$router->get('/shops', [IceCreamShopProfileController::class, 'index']);
$router->get('/shops/{id}', [IceCreamShopProfileController::class, 'indexByShopId']);
$router->get('/shops/profile/{profile}', [IceCreamShopProfileController::class, 'show']);

$router->middleware('auth:sanctum')->group(function (Router $router): void {
    $router->post('/shops', [IceCreamShopProfileController::class, 'create']);
    $router->put('/shops/profile/{profile}', [IceCreamShopProfileController::class, 'update']);
});
