<?php

namespace App\Http\Requests;

use App\Truckmake;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TruckmakeRequest extends FormRequest
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
                'required', 'min:3', Rule::unique((new Truckmake)->getTable())->ignore($this->route()->make->id ?? null)
            ]
        ];
    }
}
