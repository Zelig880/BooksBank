<?php

namespace App\Http\Requests\Bookshelf;

use App\Enums\BookCondition;
use App\Enums\BookStatus;
use App\Enums\BookshelfItemType;
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
            'title' => ['required', 'string'],
            'ISBN' => ['required'],
            'condition' => ['required', new EnumValue(BookCondition::class)],
            'type' => ['required', new EnumValue(BookshelfItemType::class)],
            'status' => ['required', new EnumValue(BookStatus::class)],
            'authors' => ['nullable'],
            'description' => ['required', 'string'],
            'categories' => ['nullable'],
            'thumbnail' => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return parent::messages() + [
            'title.unique' => 'A book with this title already exists.',
            'ISBN.unique' => 'A book with this ISBN already exists.'
        ];
    }
}
