<?php

use App\Modules\Admin\Models\Admin;
use App\Modules\Role\Models\Role;
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
            'code' => 't1158',
            'nom' => 'Keven ',
            'prenom' => 'Guerrette',
            'civilite' => 'homme',
            'telephone' => '55612719',
            'accessCode' => 'ji5848',
            'password' => bcrypt('123456'),
            'child_type' => \App\Modules\Admin\Models\Admin::class,
            'child_id' => '1',
        ]);


      
   

    }
}
