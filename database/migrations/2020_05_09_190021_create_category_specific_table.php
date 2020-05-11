<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorySpecificTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_specific', function (Blueprint $table) {
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('specific_id');

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('specific_id')->references('id')->on('specifics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_specific');
    }
}
