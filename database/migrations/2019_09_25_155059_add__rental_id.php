<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRentalId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bacs', function (Blueprint $table) {
            $table->integer('rental_id')->unsigned()->nullable();
            $table->foreign('rental_id')->references('id')->on('machine_rentals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bacs', function (Blueprint $table) {
            $table->dropColumn('rental_id');
        });
    }
}
