<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IceCreamShopPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'ice_cream_shop_id',
        'path',
        'name'
    ];

    public function iceCreamShop(): BelongsTo
    {
        return $this->belongsTo(IceCreamShop::class);
    }
}
