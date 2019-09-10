<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('order_product_id')->unsigned();
            $table->foreign('order_product_id')->references('id')->on('order_product')->onDelete('cascade');
            $table->integer('product_warehouse_id')->unsigned();
            $table->foreign('product_warehouse_id')->references('id')->on('product_warehouse')->onDelete('cascade');
            $table->float('quantity');
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
