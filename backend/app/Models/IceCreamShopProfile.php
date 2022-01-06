<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class IceCreamShopProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'ice_cream_shop_id',
        'name',
        'city',
        'description',
        'street_name',
        'street_number',
        'unit_number',
        'postal',
        'latitude',
        'longitude',
    ];

    public function iceCreamShop(): BelongsTo
    {
        return $this->belongsTo(IceCreamShop::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(IceCreamShopProfilePhoto::class);
    }

    public function menu(): HasOne
    {
        return $this->hasOne(Menu::class);
    }
}
