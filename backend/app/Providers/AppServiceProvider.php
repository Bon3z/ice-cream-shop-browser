<?php

namespace App\Providers;

use App\Services\Photo\Shop\IceCreamShopPhotoService;
use App\Services\Photo\Shop\IceCreamShopPhotoServiceInterface;
use App\Services\Profile\IceCreamShopProfileService;
use App\Services\Profile\IceCreamShopProfileServiceInterface;
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
        $this->app->bind(IceCreamShopProfileServiceInterface::class, IceCreamShopProfileService::class);
        $this->app->bind(IceCreamShopPhotoServiceInterface::class, IceCreamShopPhotoService::class);
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
