<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngredientRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'ingredient.name' => [
                'required',
                'string'
            ],
            'ingredient.serving_type' => 'nullable',
            'allergen.id' => 'nullable',
            'allergen.name' => 'nullable',
            'allergen.description' => 'nullable'
        ];
    }
}
