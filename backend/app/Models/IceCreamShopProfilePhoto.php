<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IceCreamShopProfilePhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'ice_cream_shop_profile_id',
        'path',
        'name'
    ];
}
