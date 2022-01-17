<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilteredRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'ingredient' => 'string',
            'city' => 'string',
            'perPage' => 'integer'
        ];
    }
}
