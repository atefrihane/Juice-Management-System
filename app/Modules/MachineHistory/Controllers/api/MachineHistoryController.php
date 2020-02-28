<?php

namespace App\Modules\MachineHistory\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\BacHistory\Models\BacHistory;
use App\Modules\Machine\Models\Machine;
use App\Modules\Machine\Models\MachineHistory;

class MachineHistoryController extends Controller
{
    public function handleGetMachineHistory($id)
    {
        $checkMachine = Machine::find($id);
        if ($checkMachine) {

            if (!$checkMachine->currentLocation()) {
                return response()->json(['status' => 404, 'Rental' => 'Rental not found']);
            }
            $machineHistory = MachineHistory::where('rental_id', $checkMachine->currentLocation()->id)
                ->where('machine_id', $checkMachine->id)
                ->with('user')
                ->get();
            $bacHistory = BacHistory::where('machine_rental_id', $checkMachine->currentLocation()->id)
                ->with('user')
                ->get();

            return response()->json(['status' => 200,
                'machineHistory' => $machineHistory,
                'bacHistory' => $bacHistory,
            ]);
        }
        return response()->json(['status' => 404, 'Machine' => 'Machine not found']);

    }

}
