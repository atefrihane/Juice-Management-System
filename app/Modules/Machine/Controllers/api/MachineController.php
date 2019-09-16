<?php

namespace App\Modules\Machine\Controllers\api;

use App\Http\Controllers\Controller;
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
        $checkMachine = Machine::with('histories.user')->where('id', $id)->first();

        if ($checkMachine) {

            return response()->json(['status' => 200, 'machineHistory' => $checkMachine]);

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
            return response()->json(['status' => 404,'Machine'=>'Machine not found']);
        }

        $checkUser = User::find($request->input('userId'));
        if (!$checkUser) {
            return response()->json(['status' => 404,'User'=>'User not found']);
        }
        $checkMachine->update(['status' => $request->input('status')]);

        MachineHistory::create([
            'event' => $request->input('status'),
            'comment' => $request->input('comment'),
            'user_id' => $request->input('userId'),
            'machine_id' => $id,
        ]);

        return response()->json(['status' => 200]);

    }

}
