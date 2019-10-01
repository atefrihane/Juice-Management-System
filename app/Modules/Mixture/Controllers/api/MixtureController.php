<?php

namespace App\Modules\Mixture\Controllers\api;

use App\Modules\Mixture\Models\Mixture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MixtureController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("Mixture::index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   $tab = $request->all();
         $res =[];
        foreach($tab as $mix)
        $res[] = Mixture::create($mix);
    return $res;
    }

   public function handleGetMixtures()
   {
    return(Mixture::all());
   }
}
