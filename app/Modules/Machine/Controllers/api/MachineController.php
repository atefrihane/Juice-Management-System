<?php

namespace App\Modules\Machine\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\BacHistory\Models\BacHistory;
use App\Modules\MachineRental\Models\MachineRental;
use App\Modules\Machine\Models\Machine;
use App\Modules\Machine\Models\MachineHistory;
use App\Modules\User\Models\User;
use DB;
use Illuminate\Http\Request;

class MachineController extends Controller
{

    public function show($id)
    {
        $machine = Machine::find($id);
        if ($machine) {
            $latestExpirations = DB::table('bac_products')
                ->selectRaw('bac_id, min(expiration_date) as expiration_date')
                ->groupBy('bac_id')
                ->get();

            return response()->json(['status' => 200,
                'machine' => $machine->with('bacs.products')->first(),
                'latestExpirations' => $latestExpirations]);

        }
        return response()->json(['status' => 404]);

    }

    public function showMachineStates($id, $rental_id)
    {
        $histories = [];
        $checkMachine = Machine::find($id);
        if ($checkMachine) {

            $machineHistory = MachineHistory::where('machine_id', $id)
                ->where('rental_id', $rental_id)
                ->get();

            $bacHistory = BacHistory::whereIn('bac_id', $checkMachine->bacs->pluck('id'))
                ->where('machine_rental_id', $rental_id)
                ->get();

            $histories = $machineHistory->toBase()->merge($bacHistory);
            if (!empty($histories)) {
                foreach ($histories as $history) {

                    ($history->machine_id) ? $history->setAttribute('type', 'machine') : '';
                    ($history->bac_id) ? $history->setAttribute('type', 'bac') : '';
                }
            }

            return response()->json(['status' => 200, 'histories' => $histories]);
        }

        return response()->json(['status' => 404, 'machine' => 'machine not found']);

    }

    public function handleMachineStatut($id, Request $request)
    {

        if (!$request->filled('status') ||
            !$request->filled('userId') ||
            !$request->filled('rentalId')) {
            return response()->json(['status' => 400]);

        }
        $checkMachine = Machine::find($id);
        if (!$checkMachine) {
            return response()->json(['status' => 404, 'Machine not found']);
        }
        $checkRental = MachineRental::find($request->input('rentalId'));
        if (!$checkRental) {
            return response()->json(['status' => 404, 'Rental not found']);
        }
        $checkUser = User::find($request->input('userId'));
        if (!$checkUser) {
            return response()->json(['status' => 404, 'User not found']);
        }
        $checkMachine->update(['status' => $request->input('status')]);

        MachineHistory::create([
            'event' => $request->input('status'),
            'comment' => $request->input('comment'),
            'user_id' => $request->input('userId'),
            'machine_id' => $id,
            'rental_id' => $request->input('rentalId'),

        ]);

        return response()->json(['status' => 200]);

    }

    public function showMachineBacs($id)
    {
        $machine = Machine::find($id);

        if ($machine) {
            return response()->json(['status' => 200, 'bacs' => $machine->bacs]);

        }
        return response()->json(['status' => 404]);

    }

}
