<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IceCreamShopUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required','string'],
            'city' => ['required', 'string'],
            'description' => ['string'],
            'street_name' => ['required','string'],
            'street_number' => ['required','numeric'],
            'unit_number' => ['required','numeric'],
            'postal' => ['required','string'],
            'latitude' => ['numeric'],
            'longitude' => ['numeric']
        ];
    }
}
