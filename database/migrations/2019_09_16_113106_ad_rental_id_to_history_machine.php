<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdRentalIdToHistoryMachine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('machine_histories', function (Blueprint $table) {
            $table->integer('rental_id')->unsigned()->nullable();
            $table->foreign('rental_id')->references('id')->on('machine_rentals');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('machine_histories', function (Blueprint $table) {
            $table->dropColumn('rental_id');
        });
    }
}
