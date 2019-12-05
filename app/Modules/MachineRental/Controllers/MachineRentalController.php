<?php

namespace App\Modules\MachineRental\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\MachineRental\Models\MachineRental;
use App\Modules\Machine\Models\Machine;
use App\Modules\Store\Models\Store;
use App\Modules\MachineRental\Models\MachineRentalHistory;
use Auth;
use Illuminate\Http\Request;

class MachineRentalController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("MachineRental::index");
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
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rental = MachineRental::find($id);
        // $bacs =Bac::where('rental_id',$rental->id)
        // ->get();

        if ($rental) {

     
            $store = Store::find($rental->store_id);
            return view('MachineRental::detailRentalMachine', compact('rental', 'store'));
        }
        return view('General::notFound');
    }

    public function showAllRentals($id)
    {
        $machine = Machine::find($id);
        if ($_GET['machine'] && $machine) {
            $rentals = MachineRental::where('machine_id', $machine->id)->get();
            return view('MachineRental::listRentals', compact('rentals', 'machine'));
        }
        return view('General::notFound');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function endMachineRental($id)
    {
        $rental = MachineRental::find($id);
        return view('MachineRental::stopRental', compact('rental'));
    }

    public function endRental(Request $request, $id)
    {
 

        if (!$request->date_fin) {
            alert()->error('Oups!', 'Veuillez renseigner une date de fin')->persistent('Femer');
            return redirect()->back();
        }
        $machineRental = MachineRental::find($id);

        if ($machineRental) {
            if ($machineRental->date_debut > $request->date_fin) {
                alert()->error('Oups!', 'Erreur Date!')->persistent('Femer');
                return redirect()->back();

            }
            if ($machineRental->active == 0) {
                alert()->error('Oups!', 'Cette location est deja arreté!')->persistent('Femer');
                return redirect()->back();

            }

            $machineRental->update(['end_reason' => $request->end_reason, 'date_fin' => $request->date_fin, 'active' => false, 'Comment' => $request->comment]);
            $machine = Machine::where('id', $machineRental->machine_id)->update(['rented' => false]);

            foreach ($machineRental->machine->bacs as $bac) {
                $bac->update([
                    'order' => $bac->order,
                    'status' => null,
                    'last_refill_time' => null,
                    'product_id' => null,
                    'mixture_id' => null,

                ]);
            }
            MachineRentalHistory::create([
                'action' => 'Arrêt',
                'machine_rental_id' => $machineRental->id,
                'user_id' => Auth::user()->id,
            ]);
            alert()->success('Succès!',  $machineRental->machine->designation . ' est maintenant libre !')->persistent("Fermer");
            return redirect()->route('showMachines');

        }

    }
    public function showEditRental($id)
    {
        $rental = MachineRental::find($id);
        if ($rental) {
            $store = $rental->store;
            return view('MachineRental::showEditRental', compact('rental', 'store'));
        }
        return view('General::notFound');

    }

    public function handleEditRental($id, Request $request)
    {

        $rental = MachineRental::find($id);
        if ($rental) {
            $rental->update($request->all());
            alert()->success('Succés!', 'Location modifiée avec succès')->persistent('Femer');
            return redirect()->back();

        }
        return view('General::notFound');

    }
}
