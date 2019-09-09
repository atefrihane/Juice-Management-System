<?php

namespace App\Modules\Machine\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;
use App\Modules\Machine\Models\Machine;
use App\Modules\MachineRental\Models\MachineRental;
use App\Modules\Product\Models\Product;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    public function showMachines()
    {
        $machines = Machine::all();
        return view('Machine::showMachines', compact('machines'));

    }

    public function showAddMachine()
    {

        return view('Machine::addMachine');

    }

    public function showRentedMachines($id)
    {
        $company = Company::find($id);
        $machines = $company->rentedMachines();
        if ($company) {
            return view('Machine::showRentedMachines', compact('company', 'machines'));
        }
        return view('General::notFound');

    }

    public function store(Request $request){
        $val = $request->validate([
            'code'=> 'required',
            'barcode' => 'required',
            'designation' => 'required',
            'number_bacs' => 'required|numeric',
            'price_month' => 'required|numeric'
        ], [
            'code.required' => 'le champ code est obligatoire',
            'barcode.required' => ' le champ code a barres est obligatoire',
            'designation.required'=> 'le champ designation est obligatoire',
            'number_bacs.required'=> 'le champ nombre de bacs est obligatoire',
            'number_bacs.numeric'=> 'le champ nombre de bacs doit etre un nombre',
            'price_month.required' => 'le champ prix de location mensuel est obligatoire',
            'price_month.numeric' => 'le champ prix de location mensuel n\'est pas valide'
        ]);

        $instertable = $request->all();
        if($request->file('photo') != null){
            $path = 'files/'. $request->file('photo')->store('img', 'public');
            $instertable['photo_url'] = $path;
        }
        unset($instertable['photo']);
        unset($instertable['_token']);
        $instertable['display_tablet'] = $instertable['display_tablet'] == 'true';
        Machine::create($instertable);
        return redirect(route('showMachines'));
    }

    public function edit($id){
        $machine = Machine::find($id);

        return view('Machine::edit', compact('machine'));
    }

    public function update($id, Request $request){
        $val = $request->validate([
            'code'=> 'required',
            'barcode' => 'required',
            'designation' => 'required',
            'number_bacs' => 'required|numeric',
            'price_month' => 'required|numeric'
        ], [
            'code.required' => 'le champ code est obligatoire',
            'barcode.required' => ' le champ code a barres est obligatoire',
            'designation.required'=> 'le champ designation est obligatoitr',
            'number_bacs.required'=> 'le champ nombre de bacs est obligatoire',
            'number_bacs.numeric'=> 'le champ nombre de bacs doit etre un nombre',
            'price_month.required' => 'le champ prix de location mensuel est obligatoire',
            'price_month.numeric' => 'le champ prix de location mensuel n\'est pas valide'
        ]);
        $updatable = $request->all();
        if($request->file('photo') != null){
            $path = 'files/'. $request->file('photo')->store('img', 'public');
            $updatable['photo_url'] = $path;
        }

        unset($updatable['photo']);
        unset($updatable['_token']);
        $updatable['display_tablet'] = $updatable['display_tablet'] == 'true';

        Machine::where('id', $id)->update($updatable);
        return redirect(route('showMachines'));

    }

    public function delete($id){
        $machine = Machine::find($id);
        $machine->delete();
        return redirect(route('showMachines'));
    }
    public function startRentalMachine($id){
        if($_GET['machine'])
            $machine = Machine::find($id);
            $machines = Machine::where('rented', false)->get();

            $companies = Company::all();
            $products = Product::all();

        return view('Machine::startRentalMachine', compact('machine' ,'machines', 'companies', 'products'));
    }







}
