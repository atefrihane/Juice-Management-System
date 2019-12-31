<?php

use App\Modules\Admin\Models\Admin;
use App\Modules\User\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'email' => 'test@test.fr',
            'code' => str_random(10),
            'nom' => 'Keven ',
            'prenom' => 'Guerrette',
            'civilite' => 'homme',
            'telephone' => '55612719',
            'accessCode' => 'ji5848',
            'password' => '123456',
            'child_type' => \App\Modules\Admin\Models\Admin::class,
            'child_id' => '1',
        ]);

        User::create([
            'email' => 'test@test.fr',
            'code' => str_random(10),
            'nom' => 'Jérôme ',
            'prenom' => 'Auclair',
            'civilite' => 'homme',
            'telephone' => '55612719',
            'accessCode' => 'ji5848',
            'password' => '123456',
            'child_type' => \App\Modules\User\Models\Director::class,
            'child_id' => '1',
        ]);



        User::create([
            'email' => 'test@test.fr',
            'code' => str_random(10),
            'nom' => 'Philibert ',
            'prenom' => 'Blaise',
            'civilite' => 'homme',
            'telephone' => '55612719',
            'accessCode' => 'ji5848',
            'password' => '123456',
            'child_type' => \App\Modules\User\Models\Responsible::class,
            'child_id' => '1',
        ]);

    }
}
