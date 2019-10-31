<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('status');
            $table->string('type');
            $table->string('nom');
            $table->string('designation');
            $table->string('barcode');
            $table->string('version');
            $table->string('composition');
            $table->string('color');
            $table->double('weight');
            $table->double('height');
            $table->double('width');
            $table->double('depth');
            $table->double('public_price');
            $table->double('tva');
            $table->integer('period_of_validity');
            $table->integer('validity_after_opening');
            $table->text('comment')->nullable();
            $table->string('photo_url')->nullable();
            $table->integer('unit_by_display');
            $table->integer('unit_per_package');
            $table->integer('packing');
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
        Schema::dropIfExists('products');
    }
}
