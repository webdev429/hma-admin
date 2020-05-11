<?php

namespace App\Http\Requests;

use App\Make;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MakeRequest extends FormRequest
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
                'required', 'min:3', Rule::unique((new Make)->getTable())->ignore($this->route()->make->id ?? null)
            ],
            'description' => [
                'nullable', 'min:5'
            ]
        ];
    }
}
