<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'deal_type',
        'category_id',
        'description',
        'year',
        'make_id',
        'modeld_id',
        'city',
        'state',
        'country',
        'price',
        'price_currency',
        'url',
        'picture',
        'auc_enddate',
        'auc_lot',
        'auc_auctioneer',
        'truck_year',
        'truck_make',
        'truck_model',
        'truck_engine',
        'truck_trans',
        'title',
    ];
}
