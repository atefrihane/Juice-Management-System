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
            $table->integer('order')->nullable();
            $table->double('final_amount')->nullable();
            $table->double('needed_weight')->nullable();
            $table->double('water_amount')->nullable();
            $table->double('sugar_amount')->nullable();
            $table->double('glass_size')->nullable();
            $table->double('number_of_glasses')->nullable();
            $table->integer('type')->nullable();
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
