<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IceCreamShopProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['string'],
            'city' => [ 'string'],
            'description' => ['string'],
            'street_name' => ['string'],
            'street_number' => ['numeric'],
            'unit_number' => ['numeric'],
            'postal' => ['string'],
            'latitude' => ['numeric'],
            'longitude' => ['numeric']
        ];
    }
}
