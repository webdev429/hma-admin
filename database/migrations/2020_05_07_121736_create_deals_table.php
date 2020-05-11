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
            $table->increments('id');
            $table->integer('type');
            $table->integer('category');
            $table->integer('make');
            $table->integer('model');
            $table->string('write_year', 10);
            $table->string('end_date', 30);
            $table->string('lot', 30);
            $table->integer('auctioneer');
            $table->string('country', 50);
            $table->string('state', 50);
            $table->string('city', 50);
            $table->string('picture', 50);
            $table->string('url', 100);
            $table->timestamps();
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
