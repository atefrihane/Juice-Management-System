<?php

namespace App\Modules\Machine\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;
use App\Modules\Machine\Models\Machine;
use Illuminate\Http\Request;

class MachineController extends Controller
{

    public function show($id)
    {
        return Machine::where('id', $id)->with('bacs.product')->first();
    }



}
