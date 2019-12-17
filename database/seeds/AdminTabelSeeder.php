<?php

use App\Modules\Admin\Models\Admin;
use App\Modules\User\Models\Director;
use App\Modules\User\Models\Responsible;
use Illuminate\Database\Seeder;

class AdminTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Admin::create([
            "role_id" => 1,
        ]);
        Director::create(['comment' => 'directeur']);
        Responsible::create(['comment' => 'responsable']);
    }
}
