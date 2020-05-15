<?php

namespace App\Http\Requests;

use App\Category;
use App\Make;
use App\Modeld;
use App\Type;
use App\Truckmake;
use Illuminate\Foundation\Http\FormRequest;

class DealRequest extends FormRequest
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
            'title' => [
                'required', 'min:3'
            ],
            'description' => [
                'nullable'
            ],
            'deal_type' => [
                'required'
            ],
            'type_id' => [
                'required', 'exists:'.(new Type)->getTable().',id'
            ],
            'category_id' => [
                'required', 'exists:'.(new Category)->getTable().',id'
            ],
            'year' => [
                'nullable',
                'min:4',
                'max:4'
            ],
            'make_id' => [
                'nullable',
                'exists:'.(new Make)->getTable().',id'
            ],
            'modeld_id' => [
                'nullable',
                'exists:'.(new Modeld)->getTable().',id'
            ],
            'city' => [
                'nullable'
            ],
            'state' => [
                'nullable'
            ],
            'country' => [
                'nullable'
            ],
            'price' => [
                'nullable'
            ],
            'price_currency' => [
                'nullable'
            ],
            'url' => [
                'nullable'
            ],
            'photo' => [
                $this->route()->item ? 'nullable' : 'required', 'image'
            ],
            'auc_enddate' => [
                'nullable',
                'date_format:d-m-Y'
            ],
            'auc_lot' => [
                'nullable'
            ],
            'auc_auctineer' => [
                'nullable'
            ],
            'truck_year' => [
                'nullable'
            ],
            'truck_make' => [
                'nullable',
                'exists:'.(new Truckmake)->getTable().',id'
            ],
            'truck_model' => [
                'nullable'
            ],
            'deal_engine' => [
                'nullable'
            ],
            'deal_trans' => [
                'nullable'
            ],
            'truck_suspension' => [
                'nullable'
            ],
            'truck_condition' => [
                'nullable'
            ],
            'truck_condition_unit' => [
                'nullable'
            ],
            'spec_capacity_ton' => [
                'nullable'
            ],
            'spec_capacity_ton_unit' => [
                'nullable'
            ],
            'spec_capacity_weight' => [
                'nullable'
            ],
            'spec_capacity_weight_unit' => [
                'nullable'
            ],
            'spec_capacity_cubic' => [
                'nullable'
            ],
            'spec_capacity_cubic_unit' => [
                'nullable'
            ],
            'spec_length' => [
                'nullable'
            ],
            'spec_length_unit' => [
                'nullable'
            ],
            'spec_hours' => [
                'nullable'
            ],
            'spec_extendahoe' => [
                'nullable'
            ],
            'spec_rear_aux_hyd' => [
                'nullable'
            ],
            'spec_cabin' => [
                'nullable'
            ],
            'spec_4wd' => [
                'nullable'
            ]
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            // 'category_id' => 'category',
            'photo' => 'picture'
        ];
    }
}
