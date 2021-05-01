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
<<<<<<< HEAD
            'longitude' => ['required', 'double'],
            'latitude' => ['required', 'double'],
=======
            'longitude' => ['required', 'numeric'],
            'latitude' => ['required', 'numeric'],
>>>>>>> 9d811699eb61e793d542b4c3cf6c560947eccb88
            'opening_days' => ['sometimes', 'nullable', 'array'],
            'opening_hours' => ['sometimes', 'nullable', 'array'],
            'address_line_1' => ['sometimes', 'nullable', 'string'],
            'city' => ['sometimes', 'nullable', 'string'],
            'postcode' => ['sometimes', 'nullable', 'string'],
<<<<<<< HEAD
            'delivery' => ['sometimes', 'nullable', 'string']
=======
            'delivery' => ['sometimes', 'nullable', 'numeric']
>>>>>>> 9d811699eb61e793d542b4c3cf6c560947eccb88
        ];
    }
}
