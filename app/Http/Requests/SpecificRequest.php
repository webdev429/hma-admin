<?php

namespace App\Http\Requests;

use App\Specific;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SpecificRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required', 'min:3'
            ],
            'description' => [
                'nullable', 'min:5'
            ],
            'unit' => [
                'nullable', 'min:1'
            ],
            'column_name' => [
                'nullable', 'min:3'
            ],
            'type' => [
                'nullable'
            ],
            'value' => [
                'nullable'
            ]
        ];
    }
}
