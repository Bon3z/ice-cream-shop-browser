<?php

namespace App\Http\Requests;

class IceCreamShopLoginRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required'
        ];
    }
}
