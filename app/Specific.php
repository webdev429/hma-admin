<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Specific extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'unit', 'column_name', 'type', 'data_type', 'value', 'user_id' ];
    /**
     * Get the categories of the specific data
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function createColumnToDealTable($column_name, $column_type, $unit) {
        Schema::table('deals', function($table) use ($column_name, $unit) {
            $table->string($column_name)->nullable();
            if ($unit != '') {
                $table->string($column_name.'_unit')->nullable();
            }
        });
    }

    public function changeColumnNameInDealTable($prev_col_name, $new_col_name, $unit) {
        Schema::table('deals', function($table) use ($prev_col_name, $new_col_name, $unit) {
            $table->renameColumn($prev_col_name, $new_col_name);
            if ($unit != '') {
                $table->renameColumn($prev_col_name.'_unit', $new_col_name.'_unit');
            }
        });
    }

    public function dropColumnInDealTable($col_name, $unit) {
        Schema::table('deals', function($table) use ($col_name, $unit) {
            $table->dropColumn($col_name);
            if ($unit != '') {
                $table->dropColumn($col_name.'_unit');
            }
        });
    }
}
