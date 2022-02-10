<?php

namespace App\Observers;

use App\Models\IceCreamShop;

class IceCreamShopObserver
{
    public function created(IceCreamShop $shop): void
    {
        $shop->profiles()->create();
    }
}
