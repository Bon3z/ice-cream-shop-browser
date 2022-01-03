<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IceCreamShopProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'street_name',
        'street_number',
        'unit_number',
        'postal',
        'x',
        'y',
    ];
}
