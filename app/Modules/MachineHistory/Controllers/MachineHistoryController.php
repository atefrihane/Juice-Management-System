<?php

namespace App\Modules\MachineHistory\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Machine\Models\MachineHistory;
use App\Modules\Machine\Models\Machine;
use Illuminate\Http\Request;

class MachineHistoryController extends Controller
{

    public function handleStatusChange($id)
    {
        $machine = Machine::find($id);
        return view('MachineHistory::statusChange', compact('machine'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("MachineHistory::index");
    }

    public function handleHistoryChange($id, Request $request)
    {
     
        $machineHistory = MachineHistory::find($id);
        if ($machineHistory) {

            $machineHistory->update([
                'event'=>$request->event,
                'comment'=>$request->comment
            ]);
      

            alert()->success('Succès!', 'Historique modifié avec succès !')->persistent('Femer');
            return redirect()->back();
        }
        return view('General::notFound');

    }
}
