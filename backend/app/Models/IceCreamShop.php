<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticated;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class IceCreamShop extends Authenticated
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'password_confirmation',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'accepted' => 'datetime',
    ];

    public function profiles(): HasMany
    {
        return $this->hasMany(IceCreamShopProfile::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(IceCreamShopPhoto::class);
    }
}
