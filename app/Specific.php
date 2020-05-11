<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class Specific extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'unit', 'column_name', 'type', 'value' ];
    /**
     * Get the categories of the specific data
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
