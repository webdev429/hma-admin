<?php

namespace App;

use App\Category;
use App\Make;
use Illuminate\Database\Eloquent\Model;

class Modeld extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'make_id', 'category_id'];
    /**
     * Get the category of the item
     *
     * @return \App\Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    /**
     * Get the category of the item
     *
     * @return \App\Category
     */
    public function make()
    {
        return $this->belongsTo(Make::class);
    }

}
