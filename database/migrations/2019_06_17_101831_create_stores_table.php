<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('status');
            $table->string('designation');
            $table->string('sign');
            $table->string('address');
            $table->string('complement')->nullable();
            $table->string('email');
            $table->string('tel');
            $table->string('comment')->nullable();
            $table->string('photo')->nullable();
            $table->string('bill_type');
            $table->string('bill_to');
            $table->text('deliveryRec')->nullable();
            $table->integer('order_type');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->integer('zipcode_id')->unsigned();
            $table->foreign('zipcode_id')->references('id')->on('zipcodes')->onDelete('cascade');
            $table->integer('director_id')->unsigned()->nullable();
            $table->foreign('director_id')->references('id')->on('directors')->onDelete('SET NULL');
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
        Schema::dropIfExists('stores');
    }
}
