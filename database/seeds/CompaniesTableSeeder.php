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
            'designation'=> 'des',
            'country' =>'country',
            'city' => 'Paris',
            'zip_code' => '75000',
            'address'=>'Paris Sud',
            'complement' => 'lorem',
            'comment' => 'lorem',
            'logo' => '/img/Carefour.png',
            'email'=> 'email@email.com',
            'tel'=> '55612719'

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
            'logo' => '/img/Auchan.png',
            'designation'=> 'des',
            'country' =>'country',
            'email'=> 'email@email.com',
            'tel'=> '55612719'

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
            'logo' => '/img/Cora.png',
            'designation'=> 'des',
            'country' =>'country',
            'email'=> 'email@email.com',
            'tel'=> '55612719'
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
            'logo' => '/img/Geant.png',
            'designation'=> 'des',
            'country' =>'country',
            'email'=> 'email@email.com',
            'tel'=> '55612719'
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
            'logo' => '/img/Hyper.png',
            'designation'=> 'des',
            'country' =>'country',
            'email'=> 'email@email.com',
            'tel'=> '55612719'
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
            'logo' => '/img/Intermarche.png',
            'designation'=> 'des',
            'country' =>'country',
            'email'=> 'email@email.com',
            'tel'=> '55612719'
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
            'logo' => '/img/Leclerc.png',
            'designation'=> 'des',
            'country' =>'country',
            'email'=> 'email@email.com',
            'tel'=> '55612719'

        ]);

    }
}
