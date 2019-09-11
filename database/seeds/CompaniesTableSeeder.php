<?php

use App\Modules\Company\Models\Company;
use App\Modules\Machine\Models\Machine;
use App\Modules\Store\Models\Store;
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

        $carrefour = Company::create([
            'code' => str_random(6),
            'status' => 1,
            'name' => 'Carrefour',
            'designation' => 'des',
            'country' => 'country',
            'city' => 'Paris',
            'zip_code' => '75000',
            'address' => 'Paris Sud',
            'complement' => 'lorem',
            'comment' => 'lorem',
            'logo' => '/img/Carefour.png',
            'email' => 'email@email.com',
            'tel' => '55612719',

        ]);

        Company::create([
            'code' => str_random(6),
            'status' => 2,
            'name' => 'Auchan',
            'city' => 'Paris',
            'zip_code' => '75000',
            'address' => 'Paris Sud',
            'complement' => 'lorem',
            'comment' => 'lorem',
            'logo' => '/img/Auchan.png',
            'designation' => 'des',
            'country' => 'country',
            'email' => 'email@email.com',
            'tel' => '55612719',

        ]);

        Company::create([
            'code' => str_random(6),
            'status' => 3,
            'name' => 'Cora',
            'city' => 'Paris',
            'zip_code' => '75000',
            'address' => 'Paris Sud',
            'complement' => 'lorem',
            'comment' => 'lorem',
            'logo' => '/img/Cora.png',
            'designation' => 'des',
            'country' => 'country',
            'email' => 'email@email.com',
            'tel' => '55612719',
        ]);

        Company::create([
            'code' => str_random(6),
            'status' => 4,
            'name' => 'Géant Casino',
            'city' => 'Paris',
            'zip_code' => '75000',
            'address' => 'Paris Sud',
            'complement' => 'lorem',
            'comment' => 'lorem',
            'logo' => '/img/Geant.png',
            'designation' => 'des',
            'country' => 'country',
            'email' => 'email@email.com',
            'tel' => '55612719',
        ]);

        Company::create([
            'code' => str_random(6),
            'status' => 5,
            'name' => 'Hyper U ',
            'city' => 'Paris',
            'zip_code' => '75000',
            'address' => 'Paris Sud',
            'complement' => 'lorem',
            'comment' => 'lorem',
            'logo' => '/img/Hyper.png',
            'designation' => 'des',
            'country' => 'country',
            'email' => 'email@email.com',
            'tel' => '55612719',
        ]);

        Company::create([
            'code' => str_random(6),
            'status' => 6,
            'name' => 'Intermarché Hyper ',
            'city' => 'Paris',
            'zip_code' => '75000',
            'address' => 'Paris Sud',
            'complement' => 'lorem',
            'comment' => 'lorem',
            'logo' => '/img/Intermarche.png',
            'designation' => 'des',
            'country' => 'country',
            'email' => 'email@email.com',
            'tel' => '55612719',
        ]);

        Company::create([
            'code' => str_random(6),
            'status' => 7,
            'name' => 'E.Leclerc',
            'city' => 'Paris',
            'zip_code' => '75000',
            'address' => 'Paris Sud',
            'complement' => 'lorem',
            'comment' => 'lorem',
            'logo' => '/img/Leclerc.png',
            'designation' => 'des',
            'country' => 'country',
            'email' => 'email@email.com',
            'tel' => '55612719',

        ]);

        Store::create([
            'code' => 'MGS0224',
            'status' => 'actif',
            'designation' => 'Magasin carrefour ile de france',
            'sign' => 'Franprix',
            'country' => 'France',
            'city' => 'Paris',
            'zip_code' => '75016',
            'address' => '1 Avenue du Général Sarrail, 75016 Paris, France',
            'complement' => 'aucune',
            'email' => 'contact@carefour.fr',
            'tel' => '+33 826',
            'comment' => 'Des commentaires à propos du magasin',
            'photo' => 'files/img/hKjTvBulGzfXtEK7ReQ2dahTts8UXdnkosZRjkM9.jpeg',
            'bill_type' => 'Email',
            'bill_to' => 'Magasin',
            'deliveryRec' => 'Des recommmendations pour livreur',
            'company_id' => $carrefour->id,

        ]);

        Store::create([
            'code' => 'MG20147',
            'status' => 'actif',
            'designation' => 'Magasin carefour city',
            'sign' => 'Franprix',
            'country' => 'France',
            'city' => 'Paris',
            'zip_code' => '75007',
            'address' => '42 Avenue de la Motte-Picquet, 75007 Paris, France',
            'complement' => 'aucune',
            'email' => 'contact@carefour.fr',
            'tel' => '+33 1 53 59 12 00',
            'comment' => 'Des commentaires à propos du magasin',
            'photo' => 'files/img/W83oNlw37jOsuiu1sm7pkvcK9f3J9yLgvWtHNDUj.jpeg',
            'bill_type' => 'Email',
            'bill_to' => 'Magasin',
            'deliveryRec' => 'Des recommmendations pour livreur',
            'company_id' => $carrefour->id,

        ]);

        Machine::create([
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

        Machine::create([
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

    }
}
