<?php

namespace App\Providers;

use App\Services\Auth\IceCreamShopService;
use App\Services\Auth\IceCreamShopServiceInterface;
use App\Services\Profile\IceCreamShopProfileService;
use App\Services\Profile\IceCreamShopProfileServiceInterface;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function register(): void
    {
        $this->app->bind(IceCreamShopServiceInterface::class, IceCreamShopService::class);
        $this->app->bind(IceCreamShopProfileServiceInterface::class, IceCreamShopProfileService::class);
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();
        //
    }
}
