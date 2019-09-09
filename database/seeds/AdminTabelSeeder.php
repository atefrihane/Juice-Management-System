<?php

use App\Modules\Admin\Models\Admin;
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
            "role_id" => 1
        ]);
    }
}
