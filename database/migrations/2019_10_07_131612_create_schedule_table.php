<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('day');
            $table->time('start_day_time')->nullable();
            $table->time('end_day_time')->nullable();
            $table->time('start_night_time')->nullable();
            $table->time('end_night_time')->nullable();
            $table->boolean('closed')->default(0);
            $table->integer('store_id')->unsigned();
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
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
        Schema::dropIfExists('stores_schedules');
    }
}
