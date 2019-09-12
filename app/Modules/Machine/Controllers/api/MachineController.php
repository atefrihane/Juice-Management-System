<?php

namespace App\Modules\Machine\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\Machine\Models\Machine;

class MachineController extends Controller
{

    public function show($id)
    {
        return Machine::where('id', $id)->with('bacs.product')->first();
    }

    public function showMachineStates($id)
    {

        $checkMachine = Machine::find($id);
        if ($checkMachine) {

            return response()->json(['status' => 200, 'machineHistory' => $checkMachine->histories]);

        }
        return response()->json(['status' => 404]);

    }

}
