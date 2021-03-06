<?php

use App\Http\Controllers\AllergenController;
use App\Http\Controllers\IceCreamShopController;
use App\Http\Controllers\IceCreamShopPhotoController;
use App\Http\Controllers\IceCreamShopProfileController;
use App\Http\Controllers\IceCreamShopProfilePhotoController;
use App\Http\Controllers\IngredientController;
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
// $router->get('/shops', [IceCreamShopProfileController::class, 'index']);

// Ice Cream Profiles
$router->get('/profiles', [IceCreamShopProfileController::class, 'index']);
$router->get('/shops/{id}', [IceCreamShopProfileController::class, 'indexByShopId']);
$router->get('/shops/city/{city}', [IceCreamShopProfileController::class, 'indexByCity']);
$router->get('/shops/profile/{profile}', [IceCreamShopProfileController::class, 'show']);
$router->get('/options', [IceCreamShopProfileController::class, 'options']);

// Photos
$router->get('/shops/photos/{shop}', [IceCreamShopPhotoController::class, 'show']);
$router->get('/shops/profile/photos/{profile}', [IceCreamShopProfilePhotoController::class, 'show']);

// Menus
$router->get('/shops/profile/{profile}/menu', [MenuController::class, 'index']);

$router->middleware('auth:sanctum')->group(function (Router $router): void {
    $router->delete('/shops/{shop}', [IceCreamShopController::class, 'delete']);

    $router->get('/shops/{shop}/profiles', [IceCreamShopProfileController::class, 'authIndex']);
    $router->post('/shops', [IceCreamShopProfileController::class, 'create']);
    $router->put('/shops/profile/{profile}', [IceCreamShopProfileController::class, 'update']);
    $router->delete('/shops/profile/{profile}', [IceCreamShopProfileController::class, 'delete']);

    $router->post('/shops/photos', [IceCreamShopPhotoController::class, 'create']);
    $router->delete('/shops/photos/{photo}', [IceCreamShopPhotoController::class, 'delete']);

    $router->post('/shops/profile/photos/{profile}', [IceCreamShopProfilePhotoController::class, 'create']);
    $router->delete('/shops/profile/photos/{photo}', [IceCreamShopProfilePhotoController::class, 'delete']);

    $router->post('/shops/profile/{profile}/menu', [MenuController::class, 'create']);
    $router->delete('/shops/profile/{profile}/menu', [MenuController::class, 'delete']);

    $router->post('/shops/menu/{menu}', [IngredientController::class, 'create']);
    $router->put('/shops/menu/{ingredient}', [IngredientController::class, 'update']);
    $router->delete('/shops/menu/{ingredient}', [IngredientController::class, 'delete']);

    $router->post('/shops/ingredient/{ingredient}', [AllergenController::class, 'create']);
    $router->put('/shops/ingredient/allergen/{allergen}', [AllergenController::class, 'update']);
    $router->delete('/shops/ingredient/allergen/{allergen}', [AllergenController::class, 'delete']);
});
