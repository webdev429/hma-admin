<?php

namespace App;

use App\Deal;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Truckmake extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = ['name', 'user_id'];

   /**
     * Get the tags of the item
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function deals()
    {
        return $this->hasMany(Deal::class);
    }

   /**
     * Get the tags of the item
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
