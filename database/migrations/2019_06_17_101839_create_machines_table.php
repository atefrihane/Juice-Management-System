<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('status');
            $table->string('barcode');
            $table->string('designation');
            $table->string('type');
            $table->boolean('display_tablet');
            $table->double('price_month');
            $table->string('comment')->nullable();
            $table->string('photo_url')->nullable();
            $table->boolean('rented')->default(0);
            $table->integer('machine_rental_id')->unsigned()->nullable();


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
        Schema::dropIfExists('machines');
    }
}
