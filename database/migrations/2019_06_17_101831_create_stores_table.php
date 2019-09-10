<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('country');
            $table->string('city');
            $table->string('zip_code');
            $table->string('address');
            $table->string('complement')->nullable();
            $table->string('email');
            $table->string('tel');
            $table->string('comment')->nullable();
            $table->string('photo')->nullable();
            $table->string('bill_type');
            $table->string('bill_to');
            $table->string('openingHour')->nullable();
            $table->string('closureHour')->nullable();
            $table->json('closedDays')->nullable();
            $table->text('deliveryRec')->nullable();
            $table->integer('super_visor_id')->unsigned()->nullable();
            $table->foreign('super_visor_id')->references('id')->on('super_visors')->onDelete('cascade');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

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
