<?php

namespace App\Modules\Store\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\Modules\Company\Models\Company;
use App\Modules\Store\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
   public function show($id){
       return new StoreResource(Store::find($id));
   }

   public function index(){
       return Store::all();
   }


}
