<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBacProductsFilled extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bac_products_filled', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->integer('bac_products_id')->unsigned();
            $table->foreign('bac_products_id')->references('id')->on('bac_products')->onDelete('cascade');
            $table->integer('store_products_id')->unsigned();
            $table->foreign('store_products_id')->references('id')->on('store_products')->onDelete('cascade');
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
        Schema::dropIfExists('bac_products_filled');
    }
}
