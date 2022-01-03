<?php

use App\Http\Controllers\IceCreamShopController;
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
