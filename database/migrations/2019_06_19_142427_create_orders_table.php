<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->integer('status'); //  0-> 12 //
            $table->integer('carrier')->nullable(); // 1-Interne / 2-Externe
            $table->integer('delivery_mode')->nullable(); // (1,2,3..) -> Camion,Voiture..etc
            $table->integer('cartons_number')->nullable();
            $table->integer('pallets_number')->nullable();
            $table->float('volume')->nullable();
            $table->float('weight')->nullable();
            $table->date('estimated_arrival_date')->nullable();
            $table->string('estimated_arrival_time')->nullable();
            $table->date('arrival_date')->nullable();
            $table->string('arrival_time')->nullable();
            $table->date('arrival_date_wished')->nullable();
            $table->string('comment')->nullable();
            $table->integer('store_id')->unsigned();
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->integer('delivery_man_id')->unsigned()->nullable();
            $table->foreign('delivery_man_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->integer('preparator_id')->unsigned()->nullable();
            $table->foreign('preparator_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')->references('id')->on('orders')->onDelete('SET NULL');
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
        Schema::dropIfExists('orders');
    }
}
