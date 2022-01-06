<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IceCreamShopRegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'credentials.email' => [
                'required',
                'string',
                'unique:ice_cream_shops,email',
                'email:rfc'
            ],
            'credentials.password' => [
                'required',
                'string',
                'confirmed',
                'min:6'
            ],
            'credentials.name' => ['required','string'],
            'shop.name' => ['required','string'],
            'shop.city' => ['required','string'],
            'shop.description' => ['string'],
            'shop.street_name' => ['required','string'],
            'shop.street_number' => ['required','numeric'],
            'shop.unit_number' => ['required','numeric'],
            'shop.postal' => ['required','string'],
            'shop.latitude' => ['numeric'],
            'shop.longitude' => ['numeric']
        ];
    }
}
