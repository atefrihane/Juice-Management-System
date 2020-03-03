<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreProductsHistoryDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_products_history_details', function (Blueprint $table) {
            $table->increments('id');

            $table->string('field');
            $table->string('changes');
            $table->integer('store_products_history_id')->unsigned();
            $table->foreign('store_products_history_id')->references('id')->on('store_products_history');

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
        Schema::dropIfExists('store_products_history_details');
    }
}
