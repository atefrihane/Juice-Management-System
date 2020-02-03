<?php

use Illuminate\Database\Seeder;
use App\Modules\Product\Models\Product;
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
            'public_price' =>2.99,
            'period_of_validity' =>2,
            'validity_after_opening' =>10,
            'comment' =>'',
            'photo_url' =>'',
            'unit_by_display' =>10,
            'unit_per_package' =>40,
            'packing' =>20,
            'tva'=>10
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
            'public_price' =>5.58,
            'period_of_validity' =>2,
            'validity_after_opening' =>10,
            'comment' =>'',
            'photo_url' =>'',
            'unit_by_display' =>10,
            'unit_per_package' =>40,
            'packing' =>15,
            'tva'=>10
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
            'public_price' =>3.69,
            'period_of_validity' =>3,
            'validity_after_opening' =>10,
            'comment' =>'',
            'photo_url' =>'',
            'unit_by_display' =>10,
            'unit_per_package' =>40,
            'packing' =>30,
            'tva'=>10
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
            'public_price' =>13.84,
            'period_of_validity' =>6,
            'validity_after_opening' =>10,
            'comment' =>'',
            'photo_url' =>'',
            'unit_by_display' =>10,
            'unit_per_package' =>40,
            'packing' =>40,
            'tva'=>10
        ]);
    
        
    }
}
