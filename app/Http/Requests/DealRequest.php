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
                'nullable'
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
            'sn' => [
                'nullable'
            ],
            'url' => [
                'nullable'
            ],
            'photo' => [
                $this->route()->deal ? 'nullable' : 'required', 'image'
            ],
            'auc_enddate' => [
                'nullable',
                'date_format:d-m-Y'
            ],
            'auc_lot' => [
                'nullable'
            ],
            'company' => [
                'nullable'
            ],
            'auctioneer_id' => [
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
