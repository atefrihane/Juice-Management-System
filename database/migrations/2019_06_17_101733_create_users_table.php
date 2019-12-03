'email.required' => 'le champs email est obligatoire',
            'email.email' => 'vous devez saisir un email valide ',<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('nom');
            $table->string('prenom');
            $table->string('civilite');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telephone');
            $table->string('accessCode');
            $table->integer('child_id')->unsigned()->nullable();
            $table->string('child_type')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
