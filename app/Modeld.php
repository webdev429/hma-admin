<?php

namespace App;

use App\Category;
use App\Make;
use App\Deal;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Modeld extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'make_id', 'category_id', 'user_id'];
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

    /**
     * Get the tags of the item
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function deals()
    {
        return $this->hasMany(Deal::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
