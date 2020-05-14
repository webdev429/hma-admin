<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            // General Fields
            $table->increments('id');
            $table->string('title', 100);
            $table->integer('deal_type');
            $table->unsignedInteger('category_id');
            $table->text('description')->nullable();
            $table->string('year', 4);
            $table->unsignedInteger('make_id');
            $table->unsignedInteger('modeld_id');
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('country', 50);
            $table->string('price', 50);
            $table->string('price_currency', 10);
            $table->text('url');
            $table->string('picture')->nullable();
            // Auction Fields
            $table->date('auc_enddate')->nullable();
            $table->string('auc_lot', 50)->nullable();
            $table->string('auc_auctioneer', 50)->nullable();
            // Truck Fields 
            $table->string('truck_year', 4)->nullable();
            $table->string('truck_make', 50)->nullable();
            $table->string('truck_model', 50)->nullable();
            $table->string('truck_engine', 50)->nullable();
            $table->string('truck_trans', 50)->nullable();
            $table->string('truck_suspension', 50)->nullable();
            $table->string('truck_condition', 50)->nullable();
            $table->string('truck_condition_unit', 10)->nullable();
            // Specific Fields 
            $table->float('spec_capacity_ton')->nullable();
            $table->string('spec_capacity_ton_unit', 10)->nullable();
            $table->float('spec_capacity_weight')->nullable();
            $table->string('spec_capacity_weight_unit', 10)->nullable();
            $table->float('spec_capacity_cubic')->nullable();
            $table->string('spec_capacity_cubic_unit', 10)->nullable();
            $table->float('spec_length')->nullable();
            $table->string('spec_length_unit', 10)->nullable();
            $table->string('spec_hours', 20)->nullable();
            $table->string('spec_extendahoe', 3)->nullable();
            $table->string('spec_rear_aux_hyd', 3)->nullable();
            $table->string('spec_cabin', 3)->nullable();
            $table->string('spec_4wd', 3)->nullable();

            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('make_id')->references('id')->on('makes');
            $table->foreign('modeld_id')->references('id')->on('modelds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deals');
    }
}
