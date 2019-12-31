<?php

use App\Modules\Bac\Models\Bac;
use App\Modules\Company\Models\Company;
use App\Modules\General\Models\City;
use App\Modules\General\Models\Country;
use App\Modules\General\Models\Zipcode;
use App\Modules\Machine\Models\Machine;
use App\Modules\Store\Models\Store;
use App\Modules\Store\Models\StoreSchedule;
use App\Modules\User\Models\User;
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
        $country = Country::create([
            'name' => 'France',
            'code' => 33,
        ]);
        $cityOne = City::create([
            'name' => 'Paris',
            'country_id' => $country->id,

        ]);
        $cityTwo = City::create([
            'name' => 'Marseille',
            'country_id' => $country->id,

        ]);
        $zipCodeOne = Zipcode::create([
            'code' => 75000,
            'city_id' => $cityOne->id,
        ]);


        $zipCodeTwo = Zipcode::create([
            'code' => 75001,
            'city_id' => $cityOne->id,
        ]);

        $zipCodeThree = Zipcode::create([
            'code' => 75002,
            'city_id' => $cityOne->id,
        ]);


        $zipCodeFour = Zipcode::create([
            'code' => 13000,
            'city_id' => $cityTwo->id,
        ]);

        $zipCodeFive = Zipcode::create([
            'code' => 13003,
            'city_id' => $cityTwo->id,
        ]);

    
        $zipCodeSix = Zipcode::create([
            'code' => 13006,
            'city_id' => $cityTwo->id,
        ]);

     

      

        $carrefour = Company::create([
            'code' => str_random(6),
            'status' => 1,
            'name' => 'Carrefour',
            'designation' => 'des',
            'country_id' => $country->id,
            'city_id' => $cityOne->id,
            'zipcode_id' => $zipCodeOne->id,
            'address' => 'Paris Sud',
            'complement' => 'lorem',
            'comment' => 'lorem',
            'logo' => 'img/Carefour.png',
            'email' => 'email@email.com',
            'tel' => '33 55612719',

        ]);

        Company::create([
            'code' => str_random(6),
            'status' => 2,
            'name' => 'Auchan',
            'country_id' => $country->id,
            'city_id' => $cityOne->id,
            'zipcode_id' => $zipCodeOne->id,
            'address' => 'Paris Sud',
            'complement' => 'lorem',
            'comment' => 'lorem',
            'logo' => 'img/Auchan.png',
            'designation' => 'des',
            'email' => 'email@email.com',
            'tel' => '33 55612719',

        ]);

        Company::create([
            'code' => str_random(6),
            'status' => 1,
            'name' => 'Cora',
            'zipcode_id' => $zipCodeTwo->id,
            'address' => 'Paris Sud',
            'complement' => 'lorem',
            'comment' => 'lorem',
            'logo' => 'img/Cora.png',
            'designation' => 'des',
            'country_id' => $country->id,
            'city_id' => $cityTwo->id,
            'email' => 'email@email.com',
            'tel' => '33 55612719',
        ]);

        Company::create([
            'code' => str_random(6),
            'status' => 1,
            'name' => 'Géant Casino',
            'zipcode_id' => $zipCodeTwo->id,
            'address' => 'Paris Sud',
            'complement' => 'lorem',
            'comment' => 'lorem',
            'logo' => 'img/Geant.png',
            'designation' => 'des',
            'country_id' => $country->id,
            'city_id' => $cityTwo->id,
            'email' => 'email@email.com',
            'tel' => '33 55612719',
        ]);

        Company::create([
            'code' => str_random(6),
            'status' => 1,
            'name' => 'Hyper U ',
            'zipcode_id' => $zipCodeOne->id,
            'address' => 'Paris Sud',
            'complement' => 'lorem',
            'comment' => 'lorem',
            'logo' => 'img/Hyper.png',
            'designation' => 'des',
            'country_id' => $country->id,
            'city_id' => $cityOne->id,
            'email' => 'email@email.com',
            'tel' => '33 55612719',
        ]);

        Company::create([
            'code' => str_random(6),
            'status' => 1,
            'name' => 'Intermarché Hyper ',
            'zipcode_id' => $zipCodeOne->id,
            'address' => 'Paris Sud',
            'complement' => 'lorem',
            'comment' => 'lorem',
            'logo' => 'img/Intermarche.png',
            'designation' => 'des',
            'country_id' => $country->id,
            'city_id' => $cityOne->id,
            'email' => 'email@email.com',
            'tel' => '33 55612719',
        ]);

        Company::create([
            'code' => str_random(6),
            'status' => 1,
            'name' => 'E.Leclerc',
            'country_id' => $country->id,
            'city_id' => $cityTwo->id,
            'zipcode_id' => $zipCodeTwo->id,
            'address' => 'Paris Sud',
            'complement' => 'lorem',
            'comment' => 'lorem',
            'logo' => 'img/Leclerc.png',
            'designation' => 'des',
            'email' => 'email@email.com',
            'tel' => '33 55612719',

        ]);

        $storeOne = Store::create([
            'code' => 'MGS0224',
            'status' => 'actif',
            'designation' => 'Magasin carrefour ile de france',
            'sign' => 'Franprix',
            'country_id' => $country->id,
            'city_id' => $cityOne->id,
            'zipcode_id' => $zipCodeOne->id,
            'address' => '1 Avenue du Général Sarrail, 75016 Paris, France',
            'complement' => '',
            'email' => 'contact@carefour.fr',
            'tel' => '+33 826',
            'comment' => 'Des commentaires à propos du magasin',
            'photo' => 'files/img/hKjTvBulGzfXtEK7ReQ2dahTts8UXdnkosZRjkM9.jpeg',
            'bill_type' => 'Email',
            'bill_to' => 'Magasin',
            'deliveryRec' => 'Des recommmendations pour livreur',
            'company_id' => $carrefour->id,

        ]);
        for ($i = 0; $i < 7; $i++) {
            StoreSchedule::create([
                'day' => $i + 1,
                'start_day_time' => '07:00:00',
                'end_day_time' => '12:00:00',
                'start_night_time' => '14:00:00',
                'end_night_time' => '17:00:00',
                'closed' => 0,
                'store_id'=>$storeOne->id

            ]);

        }

        $storeTwo = Store::create([
            'code' => 'MG20147',
            'status' => 'actif',
            'designation' => 'Magasin carefour city',
            'sign' => 'Franprix',
            'country_id' => $country->id,
            'city_id' => $cityTwo->id,
            'zipcode_id' => $zipCodeTwo->id,
            'address' => '42 Avenue de la Motte-Picquet, 75007 Paris, France',
            'complement' => '',
            'email' => 'contact@carefour.fr',
            'tel' => '+33 1 53 59 12 00',
            'comment' => 'Des commentaires à propos du magasin',
            'photo' => 'files/img/W83oNlw37jOsuiu1sm7pkvcK9f3J9yLgvWtHNDUj.jpeg',
            'bill_type' => 'Email',
            'bill_to' => 'Magasin',
            'deliveryRec' => 'Des recommmendations pour livreur',
            'company_id' => $carrefour->id,

        ]);
        for ($i = 0; $i < 7; $i++) {
            StoreSchedule::create([
                'day' => $i + 1,
                'start_day_time' => '08:00:00',
                'end_day_time' => '13:00:00',
                'start_night_time' => '14:00:00',
                'end_night_time' => '16:00:00',
                'closed' => 0,
                'store_id'=>$storeTwo->id

            ]);

        }


        $machineOne = Machine::create([
            'code' => 'MCH01457',
            'status' => 'Fonctionnelle',
            'barcode' => '59972846385498',
            'designation' => 'Machine de jus frais BIRTOUTA M457',
            'type' => 'Jus-granité',
            'number_bacs' => '3',
            'display_tablet' => 0,
            'price_month' => 1600,
            'comment' => 'aucun',
            'photo_url' => 'files/img/rRFdstxzLMpGWPTL4aUumSdXs44aB6kReXYVhHqL.jpeg',
            'rented' => 0,

        ]);
        for ($i = 0; $i < $machineOne->number_bacs; $i++) {
            Bac::create([
                'order' => $i + 1,
                'machine_id' => $machineOne->id,
            ]);
        }

        $machineTwo = Machine::create([
            'code' => 'MCH02589',
            'status' => 'Fonctionnelle',
            'barcode' => '87964215387996',
            'designation' => 'Machine de jus de boisson commerciale 220 V',
            'type' => 'Jus-granité',
            'number_bacs' => 2,
            'display_tablet' => 1,
            'price_month' => 1198,
            'comment' => 'aucun',
            'photo_url' => 'files/img/H1oA0MsCDqumhkYvzddm1WAMAfShQyUGeYgsGWqG.png',
            'rented' => 0,

        ]);

        for ($j = 0; $j < $machineTwo->number_bacs; $j++) {
            Bac::create([
                'order' => $j + 1,
                'machine_id' => $machineTwo->id,
            ]);
        }

       

    }
}
