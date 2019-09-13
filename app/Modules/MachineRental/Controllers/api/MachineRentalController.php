<?php

namespace App\Modules\MachineRental\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\MachineRental\Models\MachineRental;
use App\Modules\Machine\Models\Machine;
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
        $rental = $request->all();

        unset($rental['company_id']);
        $checkRental = MachineRental::where('machine_id', $rental['machine_id'])->where('active', 1)->first();
        if (!$checkRental) {
            $machineRental = MachineRental::create($rental);
            Machine::where('id', $rental['machine_id'])->update(['rented' => true, 'machine_rental_id' => $machineRental->id]);
            return $machineRental;
        }
        return response()->json(['status ' => '400']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $rental = MachineRental::find($id);
        return view('MachineRental::detailRentalMachine', compact('rental'));
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
}
