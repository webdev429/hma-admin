<?php

namespace App;

use App\Category;
use App\Make;
use App\Modeld;
use App\Type;
use App\Truckmake;
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
        'type_id',
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
        'truckmake_id',
        'truck_model',
        'truck_engine',
        'truck_trans',
        'truck_suspension',
        'truck_condition',
        'truck_condition_unit',
        'spec_capacity_ton',
        'spec_capacity_ton_unit',
        'spec_capacity_weight',
        'spec_capacity_weight_unit',
        'spec_capacity_cubic',
        'spec_capacity_cubic_unit',
        'spec_length',
        'spec_length_unit',
        'spec_hours',
        'spec_extendahoe',
        'spec_rear_aux_hyd',
        'spec_cabin',
        'spec_4wd'
    ];

    /**
     * Get the category 
     *
     * @return \App\Type
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Get the category 
     *
     * @return \App\Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the make
     *
     * @return \App\Make
     */
    public function make()
    {
        return $this->belongsTo(Make::class);
    }

    /**
     * Get the modeld
     *
     * @return \App\Modeld
     */
    public function modeld()
    {
        return $this->belongsTo(Modeld::class);
    }

    /**
     * Get the modeld
     *
     * @return \App\Truckmake
     */
    public function truckmake()
    {
        return $this->belongsTo(Truckmake::class);
    }
    
    /**
     * Get the path to the picture
     *
     * @return string
     */
    public function path()
    {
        return "/storage/{$this->picture}";
    }
}
