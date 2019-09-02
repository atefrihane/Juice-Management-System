<?php

namespace App\Modules\Store\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;
use App\Modules\Store\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
   public function show($id){
       return Store::where('id', $id)->with('stores')->first();
   }

}
