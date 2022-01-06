<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            '*' => [
                'name' => [
                    'required',
                    'string'
                ]
            ]
        ];

        return $rules;
    }

}
