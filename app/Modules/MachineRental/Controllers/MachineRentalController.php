<?php

namespace App\Modules\MachineRental\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Bac\Models\Bac;
use App\Modules\MachineRental\Models\MachineRental;
use App\Modules\Machine\Models\Machine;
use App\Modules\Store\Models\Store;
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
        $bacs =Bac::where('rental_id',$rental->id)
        ->get();

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
            return view('MachineRental::listRentals', compact('rentals','machine'));
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
        if(!$request->date_fin)
        {
            alert()->error('Oups!','Veuillez renseigner une date de fin')->persistent('Femer');
            return redirect()->back();
        }

        MachineRental::where('id', $id)->update(['end_reason' => $request->end_reason, 'date_fin' => $request->date_fin, 'active' => false, 'Comment' => $request->comment]);
        $rental = MachineRental::find($id);
        $machine = Machine::where('id', $rental->machine_id)->update(['rented' => false]);
        Bac::where('machine_id', $rental->machine_id)->delete();
        alert()->success('Succés!', 'La machine ' . $rental->machine->code . ' est maintenant libre !')->persistent("Fermer");
        return redirect(route('showMachines'));

    }
}
