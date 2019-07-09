<?php

use App\Modules\Company\Models\Company;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Company::create([
            'code' => str_random(6),
            'status' => 1,
            'name' => 'Carrefour',
            'city' => 'Paris',
            'zip_code' => '75000',
            'address'=>'Paris Sud',
            'complement' => 'lorem',
            'comment' => 'lorem',
            'logo' => 'Carefour.png',

        ]);

        Company::create([
            'code' => str_random(6),
            'status' => 2,
            'name' => 'Auchan',
            'city' => 'Paris',
            'zip_code' => '75000',
            'address'=>'Paris Sud',
            'complement' => 'lorem',
            'comment' => 'lorem',
            'logo' => 'Auchan.png',

        ]);



        Company::create([
            'code' => str_random(6),
            'status' => 3,
            'name' => 'Cora',
            'city' => 'Paris',
            'zip_code' => '75000',
            'address'=>'Paris Sud',
            'complement' => 'lorem',
            'comment' => 'lorem',
            'logo' => 'Cora.png',

        ]);



        Company::create([
            'code' => str_random(6),
            'status' => 4,
            'name' => 'Géant Casino',
            'city' => 'Paris',
            'zip_code' => '75000',
            'address'=>'Paris Sud',
            'complement' => 'lorem',
            'comment' => 'lorem',
            'logo' => 'Geant.png',

        ]);


        Company::create([
            'code' => str_random(6),
            'status' => 5,
            'name' => 'Hyper U ',
            'city' => 'Paris',
            'zip_code' => '75000',
            'address'=>'Paris Sud',
            'complement' => 'lorem',
            'comment' => 'lorem',
            'logo' => 'Hyper.png',

        ]);


        Company::create([
            'code' => str_random(6),
            'status' => 6,
            'name' => 'Intermarché Hyper ',
            'city' => 'Paris',
            'zip_code' => '75000',
            'address'=>'Paris Sud',
            'complement' => 'lorem',
            'comment' => 'lorem',
            'logo' => 'Intermarche.png',

        ]);



        Company::create([
            'code' => str_random(6),
            'status' => 7,
            'name' => 'E.Leclerc',
            'city' => 'Paris',
            'zip_code' => '75000',
            'address'=>'Paris Sud',
            'complement' => 'lorem',
            'comment' => 'lorem',
            'logo' => 'Leclerc.png',

        ]);

    }
}
