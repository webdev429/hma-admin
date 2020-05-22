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
            $table->engine = 'InnoDB';
            // General Fields
            $table->bigIncrements('id');
            $table->string('title', 100);
            $table->integer('deal_type');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('category_id');
            $table->text('description')->nullable();
            $table->string('year', 4);
            $table->unsignedInteger('make_id');
            $table->unsignedInteger('modeld_id');
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('price', 50)->nullable();
            $table->string('price_currency', 10)->nullable();
            $table->integer('premium')->nullable();
            $table->text('sn')->nullable();
            $table->text('url')->nullable();
            $table->string('picture')->nullable();
            // Auction Fields
            $table->date('auc_enddate')->nullable();
            $table->string('auc_lot', 50)->nullable();
            $table->string('company')->nullable();
            $table->unsignedInteger('auctioneer_id')->nullable();
            // Truck Fields 
            $table->string('truck_year', 4)->nullable();
            $table->unsignedInteger('truckmake_id')->nullable();
            $table->string('truck_model', 50)->nullable();
            $table->string('truck_engine', 50)->nullable();
            $table->string('truck_trans', 50)->nullable();
            $table->string('truck_suspension', 50)->nullable();
            $table->string('truck_condition', 50)->nullable();
            $table->string('truck_condition_unit', 10)->nullable();
            // Specific Fields 
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('types');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('make_id')->references('id')->on('makes');
            $table->foreign('modeld_id')->references('id')->on('modelds');
            $table->foreign('truckmake_id')->references('id')->on('truckmakes');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('auctioneer_id')->references('id')->on('auctioneers');
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
