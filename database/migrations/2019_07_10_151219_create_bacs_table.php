<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBacsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bacs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order');
            $table->double('final_amount');
            $table->double('needed_weight');
            $table->double('water_amount');
            $table->double('sugar_amount');
            $table->double('glass_size');
            $table->double('number_of_glasses');
            $table->integer('status')->nullable();
            $table->dateTime('last_refill_time')->nullable();
            $table->integer('machine_id')->unsigned();
            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('cascade');
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
        Schema::dropIfExists('bacs');
    }
}
