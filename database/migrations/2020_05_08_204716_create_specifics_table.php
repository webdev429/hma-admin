<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecificsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specifics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('unit', 20)->nullable();
            $table->string('column_name', 50);
            $table->integer('type');
            $table->integer('data_type');
            $table->text('value')->nullable();
            $table->integer('limit')->nullable();
            $table->tinyInteger('required')->default(0);
            $table->tinyInteger('truck_data')->default(0);
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specifics');
    }
}
