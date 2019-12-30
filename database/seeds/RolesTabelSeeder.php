<?php

use App\Modules\Role\Models\Role;
use Illuminate\Database\Seeder;

class RolesTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Role::create([
            "role_name"=> 'DBO'
        ]);
        Role::create([
            "role_name"=> 'SUPERADMIN'
        ]);
        Role::create([
            "role_name"=> 'ADMIN'
        ]);
        Role::create([
            "role_name"=> 'PREPARATOR'
        ]);

        Role::create([
            "role_name"=> 'MAIN_DELIVERY'
        ]);

        Role::create([
            "role_name"=> 'SECOND_DELIVERY'
        ]);

    }
}
