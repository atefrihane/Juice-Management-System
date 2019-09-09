<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMixturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mixtures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->double('final_amount');
            $table->double('needed_weight');
            $table->double('water_amount');
            $table->double('sugar_amount');
            $table->double('glass_size');
            $table->double('number_of_glasses');
            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('mixtures');
    }
}
