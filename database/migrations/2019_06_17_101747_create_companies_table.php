<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->integer('status');
            $table->string('name');
            $table->string('country');
            $table->string('designation');
            $table->string('city');
            $table->string('zip_code');
            $table->string('address');
            $table->string('complement')->nullable();
            $table->string('email');
            $table->string('tel');
            $table->string('comment')->nullable();
            $table->string('logo');

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
        Schema::dropIfExists('companies');
    }
}
