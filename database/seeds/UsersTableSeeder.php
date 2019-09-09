<?php

use Illuminate\Database\Seeder;
use App\Modules\User\Models\User;

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
            'email'=>'test@test.fr',
            'code'=> 't1158',
            'nom' => 'nom',
            'prenom'=> 'prenom',
            'civilite'=> 'homme',
            'telephone'=> '55612719',
            'accessCode'=>'ji5848',
            'password'=>bcrypt('123456'),
            'child_type' => \App\Modules\Admin\Models\Admin::class,
            'child_id' => '1'
        ]);
    }
}
