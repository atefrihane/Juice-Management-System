<?php

namespace App\Modules\Machine\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\MachineRental\Models\MachineRental;
use App\Modules\Machine\Models\Machine;
use App\Modules\Machine\Models\MachineHistory;
use App\Modules\User\Models\User;
use Illuminate\Http\Request;

class MachineController extends Controller
{

    public function show($id)
    {
        return Machine::where('id', $id)->with('bacs.product')->first();
    }

    public function showMachineStates($id)
    {

        $machineRental = MachineRental::where('machine_id', $id)
            ->where('active', 1)
            ->first();
        if ($machineRental) {
           
            $history = MachineHistory::where('machine_id', $id)
                ->where('rental_id', $machineRental->id)
                ->get();

            return response()->json(['status' => 200, 'machineHistory' => $history]);

        }
        return response()->json(['status' => 404]);

    }

    public function handleMachineStatut($id, Request $request)
    {
        if (!$request->input('status') || !$request->input('userId')) {
            return response()->json(['status' => 400]);

        }
        $checkMachine = Machine::find($id);
        if (!$checkMachine) {
            return response()->json(['status' => 404, 'Machine' => 'Machine not found']);
        }

        $checkUser = User::find($request->input('userId'));
        if (!$checkUser) {
            return response()->json(['status' => 404, 'User' => 'User not found']);
        }
        $checkMachine->update(['status' => $request->input('status')]);
        $rentalId = $checkMachine->machineRentals->where('active', 1)->first();

        return response()->json(['status' => $rentalId]);

        MachineHistory::create([
            'event' => $request->input('status'),
            'comment' => $request->input('comment'),
            'user_id' => $request->input('userId'),
            'machine_id' => $id,
            'rental_id' => $rentalId->id,

        ]);

        return response()->json(['status' => 200]);

    }

}
