<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'ice_cream_shop_id'
    ];

    public function iceCreamShopProfile(): BelongsTo
    {
        return $this->belongsTo(IceCreamShopProfile::class);
    }

    public function ingredients(): HasManyThrough
    {
        return $this->hasManyThrough(Allergen::class, Ingredient::class);
    }
}
