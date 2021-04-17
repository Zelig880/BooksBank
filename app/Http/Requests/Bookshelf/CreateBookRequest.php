<?php

namespace App\Http\Requests\Bookshelf;

use App\Enums\BookCondition;
use App\Enums\BookStatus;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
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
            'title' => 'required',
            'ISBN' => 'required',
            'condition' => ['required', new EnumValue(BookCondition::class)],
            'status' => ['required', new EnumValue(BookStatus::class)]
        ];
    }
}
