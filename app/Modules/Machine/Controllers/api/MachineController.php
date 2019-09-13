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
        $checkMachine = Machine::with('histories.user')->where('id', $id)->first();

        if ($checkMachine) {

            return response()->json(['status' => 200, 'machineHistory' => $checkMachine]);

        }
        return response()->json(['status' => 404]);

    }

}
