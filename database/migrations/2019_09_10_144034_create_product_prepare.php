<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPrepare extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_prepare', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('order_product')->onDelete('cascade');
            $table->integer('product_warehouse_id')->unsigned();
            $table->foreign('product_warehouse_id')->references('id')->on('product_warehouse')->onDelete('cascade');
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
        Schema::dropIfExists('product_prepare');
    }
}
