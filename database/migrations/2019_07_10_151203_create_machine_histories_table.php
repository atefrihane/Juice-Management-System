<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMachineHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('event');
            $table->text('comment')->nullable();
            $table->integer('machine_id')->unsigned()->nullable();
            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('rental_id')->unsigned()->nullable();
            $table->foreign('rental_id')->references('id')->on('machine_rentals')->onDelete('cascade');
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
        Schema::dropIfExists('machine_histories');
    }
}
