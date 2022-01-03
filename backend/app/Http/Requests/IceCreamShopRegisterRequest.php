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
            'email' => [
                'required',
                'string',
                'unique:ice_cream_shops',
                'email:rfc'
            ],
            'password' => [
                'required',
                'string',
                'confirmed',
                'min:6'
            ]
        ];
    }
}
