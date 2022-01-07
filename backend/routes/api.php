<?php

use App\Http\Controllers\IceCreamShopController;
use App\Http\Controllers\IceCreamShopPhotoController;
use App\Http\Controllers\IceCreamShopProfileController;
use App\Http\Controllers\IceCreamShopProfilePhotoController;
use App\Http\Controllers\MenuController;
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

// Ice Cream Shops
$router->get('/shops', [IceCreamShopProfileController::class, 'index']);

// Ice Cream Profiles
$router->get('/shops/{id}', [IceCreamShopProfileController::class, 'indexByShopId']);
$router->get('/shops/city/{city}', [IceCreamShopProfileController::class, 'indexByCity']);
$router->get('/shops/profile/{profile}', [IceCreamShopProfileController::class, 'show']);

// Photos
$router->get('/shops/photos/{shop}', [IceCreamShopPhotoController::class, 'show']);
$router->get('/shops/profile/photos/{profile}', [IceCreamShopProfilePhotoController::class, 'show']);

// Menus
$router->get('/shops/profile/{profile}/menu', [MenuController::class, 'index']);

$router->middleware('auth:sanctum')->group(function (Router $router): void {
    $router->post('/shops', [IceCreamShopProfileController::class, 'create']);
    $router->put('/shops/profile/{profile}', [IceCreamShopProfileController::class, 'update']);

    $router->post('/shops/photos', [IceCreamShopPhotoController::class, 'create']);
    $router->delete('/shops/photos/{photo}', [IceCreamShopPhotoController::class, 'delete']);

    $router->post('/shops/profile/photos', [IceCreamShopProfilePhotoController::class, 'create']);
    $router->delete('/shops/profile/photos/{photo}', [IceCreamShopProfilePhotoController::class, 'delete']);

    $router->post('/shops/profile/{profile}/menu', [MenuController::class, 'create']);
});
