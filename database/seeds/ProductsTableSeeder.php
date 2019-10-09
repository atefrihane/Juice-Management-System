<?php

use Illuminate\Database\Seeder;
use App\Modules\Product\Models\Product;
use App\Modules\Mixture\Models\Mixture;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manga=Product::create([
            'code' =>'PROD2547',
            'status' =>'disponible',
            'type' =>'alimentaire',
            'nom' =>'Jus de Mangue',
            'designation' =>'Pulpe de Mangue - Wana Bana - Sans sucre',
            'barcode' =>'2548799666974415646',
            'version' =>'25646ikj',
            'composition' =>'Concenté de pulpe de Mangue',
            'color' =>'#ff8040',
            'weight' =>2,
            'height' =>15,
            'width' =>15,
            'depth' =>15,
            'public_price' =>15,
            'period_of_validity' =>150,
            'validity_after_opening' =>10,
            'comment' =>'',
            'photo_url' =>'',
            'unit_by_display' =>10,
            'unit_per_package' =>40,
            'packing' =>20,
        ]);
        Mixture::create([
            'name' => 'Mangue 1 ',
            'type'=>'jus',
            'final_amount' => 200,
            'needed_weight' => 50,
            'water_amount' => 10,
            'sugar_amount' => 10,
            'glass_size' => 20,
            'number_of_glasses' => 1000,
            'product_id' => $manga->id,
        ]);

        $ananas=Product::create([
            'code' =>'PROD2541',
            'status' =>'disponible',
            'type' =>'alimentaire',
            'nom' =>'Jus Ananas',
            'designation' =>'Pulpe Ananas - Wana Bana - Sans sucre',
            'barcode' =>'2548799666974415646',
            'version' =>'25646ikj',
            'composition' =>'Concenté de pulpe Ananas',
            'color' =>'#ff8040',
            'weight' =>2,
            'height' =>15,
            'width' =>15,
            'depth' =>15,
            'public_price' =>15,
            'period_of_validity' =>150,
            'validity_after_opening' =>10,
            'comment' =>'',
            'photo_url' =>'',
            'unit_by_display' =>10,
            'unit_per_package' =>40,
            'packing' =>20,
        ]);
        Mixture::create([
            'name' => 'Ananas 1 ',
            'type'=>'jus',
            'final_amount' => 200,
            'needed_weight' => 50,
            'water_amount' => 10,
            'sugar_amount' => 10,
            'glass_size' => 20,
            'number_of_glasses' => 1000,
            'product_id' => $ananas->id,
        ]);
        


        $goyave=Product::create([
            'code' =>'PROD2512',
            'status' =>'disponible',
            'type' =>'alimentaire',
            'nom' =>'Jus de Goyave',
            'designation' =>'Pulpe de Goyave - Wana Bana - Sans sucre',
            'barcode' =>'2548799666974415646',
            'version' =>'25646ikj',
            'composition' =>'Concenté de pulpe de Goyave',
            'color' =>'#ff8040',
            'weight' =>2,
            'height' =>15,
            'width' =>15,
            'depth' =>15,
            'public_price' =>15,
            'period_of_validity' =>150,
            'validity_after_opening' =>10,
            'comment' =>'',
            'photo_url' =>'',
            'unit_by_display' =>10,
            'unit_per_package' =>40,
            'packing' =>20,
        ]);
        Mixture::create([
            'name' => 'Goyave 1 ',
            'type'=>'jus',
            'final_amount' => 200,
            'needed_weight' => 50,
            'water_amount' => 10,
            'sugar_amount' => 10,
            'glass_size' => 20,
            'number_of_glasses' => 1000,
            'product_id' => $goyave->id,
        ]);



       $corossol= Product::create([
            'code' =>'PROD2598',
            'status' =>'disponible',
            'type' =>'alimentaire',
            'nom' =>'Jus de Corossol',
            'designation' =>'Pulpe de Corossol - Wana Bana - Sans sucre',
            'barcode' =>'2548799666974415646',
            'version' =>'25646ikj',
            'composition' =>'Concenté de pulpe de Corossol',
            'color' =>'#ff8040',
            'weight' =>2,
            'height' =>15,
            'width' =>15,
            'depth' =>15,
            'public_price' =>15,
            'period_of_validity' =>150,
            'validity_after_opening' =>10,
            'comment' =>'',
            'photo_url' =>'',
            'unit_by_display' =>10,
            'unit_per_package' =>40,
            'packing' =>20,
        ]);
        Mixture::create([
            'name' => 'Corossol 1 ',
            'final_amount' => 200,
            'type'=>'jus',
            'needed_weight' => 50,
            'water_amount' => 10,
            'sugar_amount' => 10,
            'glass_size' => 20,
            'number_of_glasses' => 1000,
            'product_id' => $corossol->id,
        ]);
        
    }
}
