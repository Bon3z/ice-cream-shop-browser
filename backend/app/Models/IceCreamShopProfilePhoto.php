<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IceCreamShopProfilePhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'ice_cream_shop_profile_id',
        'path',
        'name'
    ];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(IceCreamShopProfile::class);
    }
}
