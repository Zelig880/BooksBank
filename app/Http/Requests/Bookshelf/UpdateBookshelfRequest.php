<?php

namespace App\Http\Requests\Bookshelf;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookshelfRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'longitude' => ['required', 'numeric'],
            'latitude' => ['required', 'numeric'],
            'opening_days' => ['sometimes', 'nullable', 'array'],
            'opening_hours' => ['sometimes', 'nullable', 'array'],
            'address_line_1' => ['sometimes', 'nullable', 'string'],
            'city' => ['sometimes', 'nullable', 'string'],
            'postcode' => ['sometimes', 'nullable', 'string'],
            'delivery' => ['sometimes', 'nullable', 'numeric']
        ];
    }
}