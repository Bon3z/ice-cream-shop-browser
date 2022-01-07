<?php

namespace App\Providers;

use App\Services\Ingredient\IngredientService;
use App\Services\Ingredient\IngredientServiceInterface;
use App\Services\Menu\MenuService;
use App\Services\Menu\MenuServiceInterface;
use App\Services\Photo\Profile\IceCreamShopProfilePhotoService;
use App\Services\Photo\Profile\IceCreamShopProfilePhotoServiceInterface;
use App\Services\Photo\Shop\IceCreamShopPhotoService;
use App\Services\Photo\Shop\IceCreamShopPhotoServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IceCreamShopProfilePhotoServiceInterface::class, IceCreamShopProfilePhotoService::class);
        $this->app->bind(IceCreamShopPhotoServiceInterface::class, IceCreamShopPhotoService::class);
        $this->app->bind(MenuServiceInterface::class, MenuService::class);
        $this->app->bind(IngredientServiceInterface::class, IngredientService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
