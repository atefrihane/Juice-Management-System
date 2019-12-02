<?php

namespace App\Modules\Machine\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Bac\Models\Bac;
use App\Modules\Company\Models\Company;
use App\Modules\Machine\Models\Machine;
use App\Modules\Machine\Models\MachineHistory;
use App\Modules\Product\Models\Product;
use Auth;
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
        $checkMachine = Machine::count();
        if ($checkMachine > 0) {
            $nextMachine = Machine::all()->last()->id + 1;

        } else {
            $nextMachine = 1;
        }

        return view('Machine::addMachine', compact('nextMachine'));

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

    public function store(Request $request)
    {

        $val = $request->validate([
            'code' => 'required',
            'barcode' => 'required',
            'designation' => 'required',
            'number_bacs' => 'required|numeric',
            'price_month' => 'required|numeric',
        ], [
            'code.required' => 'le champ code est obligatoire',
            'barcode.required' => ' le champ code a barres est obligatoire',
            'designation.required' => 'le champ designation est obligatoire',
            'number_bacs.required' => 'le champ nombre de bacs est obligatoire',
            'number_bacs.numeric' => 'le champ nombre de bacs doit etre un nombre',
            'price_month.required' => 'le champ prix de location mensuel est obligatoire',
            'price_month.numeric' => 'le champ prix de location mensuel n\'est pas valide',
        ]);

        $instertable = $request->all();
        if ($request->file('photo') != null) {
            $path = 'files/' . $request->file('photo')->store('img', 'public');
            $instertable['photo_url'] = $path;
        }
        unset($instertable['photo']);
        unset($instertable['_token']);
        $instertable['display_tablet'] = $instertable['display_tablet'] == 'true';
        $machine = Machine::create($instertable);
        MachineHistory::create([
            'event' => $request->status,
            'comment' => $request->comment,
            'machine_id' => $machine->id,
            'user_id' => Auth::id(),

        ]);
        for ($i = 0; $i < $request->number_bacs; $i++) {
            Bac::create([
                'order' => $i + 1,
                'machine_id' => $machine->id,
            ]);

        }

        alert()->success('Succès!', 'une nouvelle machine a été crée avec succès !')->persistent("Fermer");
        return redirect(route('showMachines'));
    }

    public function edit($id)
    {
        $machine = Machine::find($id);

        return view('Machine::edit', compact('machine'));
    }

    public function update($id, Request $request)
    {
        $val = $request->validate([
            'code' => 'required',
            'barcode' => 'required',
            'designation' => 'required',
            'price_month' => 'required|numeric',
        ], [
            'code.required' => 'le champ code est obligatoire',
            'barcode.required' => ' le champ code a barres est obligatoire',
            'designation.required' => 'le champ designation est obligatoitr',
            'price_month.required' => 'le champ prix de location mensuel est obligatoire',
            'price_month.numeric' => 'le champ prix de location mensuel n\'est pas valide',
        ]);
        $updatable = $request->all();
        if ($request->file('photo') != null) {
            $path = 'files/' . $request->file('photo')->store('img', 'public');
            $updatable['photo_url'] = $path;
        }

        unset($updatable['photo']);
        unset($updatable['_token']);
        $updatable['display_tablet'] = $updatable['display_tablet'] == 'true';
        $machine = Machine::find($id);
        if ($machine) {
            $machine->update($updatable);
            if ($request->has('number_bacs')) {
                $oldBacs = $machine->number_bacs;
                $newBacs = $request->number_bacs;
                if ($newBacs > $oldBacs) {
                    $difference = $newBacs - $oldBacs;
                    for ($i = 0; $i < $difference; $i++) {
                        Bac::create([
                            'order' => Bac::all()->last()->order + 1,
                            'machine_id' => $machine->id,
                        ]);
                    }
                    $machine->number_bacs = $oldBacs + $difference;
                } else {
                    $machine->bacs()->delete();
                    for ($i = 0; $i < $newBacs; $i++) {
                        Bac::create([
                            'order' => $i + 1,
                            'machine_id' => $machine->id,
                        ]);
                    }
                    $machine->number_bacs = $newBacs;

                }

            }
            alert()->success('Succès!', 'La machine a été modifiée avec succès ')->persistent("Fermer");
            return redirect(route('showMachines'));

        }
        return view('General::notFound');

    }

    public function delete($id)
    {
        $machine = Machine::find($id);
        if($machine)
        {
            if(!$machine->machineRentals()->exists())
            {
                $machine->delete();
                alert()->success('Succès!', 'La machine a été supprimé avec succès ')->persistent("Fermer");
                return redirect(route('showMachines'));

            }
            else{
                alert()->error('Impossible de supprimer cette machine !', 'Oups! ')->persistent("Fermer");
                return redirect()->back();
            }
           

        }
        return view('General::notFound');
     
    }
    public function startRentalMachine($id)
    {

        if ($_GET['machine']) {
            $machine = Machine::find($id);
            if ($machine->rented == 1) {
                return view('General::notFound');
            }
        }

        $machines = Machine::where('rented', false)->get();

        $companies = Company::all();
        $products = Product::all();

        return view('Machine::startRentalMachine', compact('machine', 'machines', 'companies', 'products'));
    }

    public function handleUpdateState($id, Request $request)
    {

        $checkMachine = Machine::find($id);
        if ($checkMachine) {
            $checkMachine->update([
                'status' => $request->status,
            ]);
            $rental = $checkMachine->machineRentals->where('active', 1)->first();

            MachineHistory::create([
                'event' => $request->status,
                'comment' => $request->comment,
                'machine_id' => $checkMachine->id,
                'user_id' => Auth::id(),
                'rental_id' => $rental ? $rental->id : null,
            ]);

            alert()->success('Succès!', 'Le nouveau etat  de la machine est bien à jour !')->persistent("Fermer");
            return redirect()->route('showMachines');

        }
        return view('General::notFound');

    }

    public function showHistoryMachine($id)
    {
        $machine = Machine::find($id);

        if ($machine) {

            return view('Machine::showHistoryMachine', compact('machine'));
        }
        return view('General::notFound');
    }
  

}
