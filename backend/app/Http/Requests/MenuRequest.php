<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            '*' => [
                '*.ingredient.name' => [
                    'required',
                    'string'
                ],
                '*.ingredient.serving_type' => 'nullable',
                '*.allergen.name' => 'nullable',
                '*.allergen.description' => 'nullable'
            ]
        ];
    }

}
