<?php

namespace App;

use App\Category;
use App\Make;
use App\Modeld;
use App\Type;
use App\Truckmake;
use App\Specifics;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


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
        'sn',
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
        'user_id'
    ];

    public function __construct(array $attributes = array()) 
    {
        $this->setFillable();
        parent::__construct($attributes);
    }

    public function setFillable()
    {
        $speclist = DB::table('specifics')->get();

        foreach ($speclist as $spec) {
            // print_r($this->fillable);exit();
            array_push($this->fillable, $spec->column_name);
            if ($spec->unit != '') {
                array_push($this->fillable, $spec->column_name.'_unit');
            }
        }
    }

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

    public function user() {
        return $this->belongsTo(User::class);
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
