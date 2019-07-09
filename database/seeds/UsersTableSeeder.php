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
            'password'=>bcrypt('123456')
        ]);
    }
}
