<?php

namespace App\Modules\Machine\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Bac\Models\Bac;
use App\Modules\Company\Models\Company;
use App\Modules\Machine\Models\Machine;
use App\Modules\Machine\Models\MachineHistory;
use App\Modules\Product\Models\Product;
use App\Repositories\Image;
use Auth;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    protected $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }
    public function showMachines()
    {

        $machines = Machine::with(['machineRentals.store.city', 'machineRentals' => function ($q) {
            $q->where('active', 1);
        }])->get();

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
            'price_month' => 'required|numeric|min:0|max:999999',
            'photo' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ], [
            'code.required' => ' Code est obligatoire',
            'barcode.required' => '  Code a barres est obligatoire',
            'designation.required' => ' Designation est obligatoire',
            'price_month.required' => ' Prix de location mensuel est obligatoire',
            'price_month.numeric' => ' Prix de location mensuel n\'est pas valide',
            'price_month.min' => ' Prix de location mensuel n\'est pas valide',
            'price_month.max' => ' Prix de location mensuel n\'est pas valide',
            'photo.image' => 'Le format du logo importé est non supporté ',
            'photo.mimes' => 'Le format du logo importé est non supporté ',
            'photo.max' => 'Logo importé est volumineux ! ',
        ]);

        $instertable = $request->except(['photo', '_token']);

        if ($request->photo) {
            $path = $this->image->uploadBinaryImage($request->photo);
            $instertable['photo_url'] = $path;
        }

        unset($instertable['photo']);
        unset($instertable['_token']);
        unset($instertable['number_bacs']);

        $instertable['display_tablet'] = $instertable['display_tablet'] == 'true';
        $machine = Machine::create($instertable);
        $bacs = array();
        //Bulk Insert Bacs
        for ($i = 0; $i < $request->number_bacs; $i++) {
            $newBac = [
                'order' => $i + 1,
                'machine_id' => $machine->id,
            ];
            array_push($bacs, $newBac);

        }
        Bac::insert($bacs);

        MachineHistory::create([
            'event' => 'Création',
            'comment' => $request->comment,
            'machine_id' => $machine->id,
            'user_id' => Auth::id(),

        ]);

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
            'price_month' => 'required|numeric|min:0|max:999999',
            'photo' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ], [
            'code.required' => ' Code est obligatoire',
            'barcode.required' => '  Code a barres est obligatoire',
            'designation.required' => ' Designation est obligatoire',
            'price_month.required' => ' Prix de location mensuel est obligatoire',
            'price_month.numeric' => ' Prix de location mensuel n\'est pas valide',
            'price_month.min' => ' Prix de location mensuel n\'est pas valide',
            'price_month.max' => ' Prix de location mensuel n\'est pas valide',
            'photo.image' => 'Le format du logo importé est non supporté ',
            'photo.mimes' => 'Le format du logo importé est non supporté ',
            'photo.max' => 'Logo importé est volumineux ! ',
        ]);
        
        $updatable = $request->all();
        if ($request->photo) {
            $path = $this->image->uploadBinaryImage($request->photo);

            $updatable['photo_url'] = $path;
        }

        unset($updatable['photo']);
        unset($updatable['_token']);
        unset($updatable['number_bacs']);
        $updatable['display_tablet'] = $updatable['display_tablet'] == 'true';
        $machine = Machine::find($id);
        if ($machine) {
            $machine->update($updatable);

            if ($request->has('number_bacs')) {
                $storedBacs = array();
                $oldBacs = count($machine->bacs);
                $newBacs = $request->number_bacs;
                if ($newBacs > $oldBacs) {

                    $difference = $newBacs - $oldBacs;
                    for ($i = 0; $i < $difference; $i++) {
                        $oldBacs++;
                        $bac = [
                            'order' => $oldBacs,
                            'machine_id' => $machine->id,
                        ];
                        array_push($storedBacs, $bac);

                    }
                    Bac::insert($storedBacs);

                } else {
                    $machine->bacs()->delete();
                    for ($i = 0; $i < $newBacs; $i++) {
                        $bac = [
                            'order' => $i + 1,
                            'machine_id' => $machine->id,
                        ];
                        array_push($storedBacs, $bac);
                    }
                    Bac::insert($storedBacs);

                }

            }

            MachineHistory::create([
                'event' => 'Modification',
                'comment' => $request->comment,
                'machine_id' => $machine->id,
                'user_id' => Auth::id(),

            ]);
            alert()->success('Succès!', 'La machine a été modifiée avec succès ')->persistent("Fermer");
            return redirect(route('showMachines'));

        }
        return view('General::notFound');

    }

    public function delete($id)
    {
        $machine = Machine::find($id);
        if ($machine) {
            if (!$machine->machineRentals()->exists()) {
                $machine->delete();
                alert()->success('Succès!', 'La machine a été supprimé avec succès ')->persistent("Fermer");
                return redirect(route('showMachines'));

            } else {
                alert()->error('Cette entité ne peut pas être supprimée, autres entités y sont liées', 'Oups! ')->persistent("Fermer");
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
                'event' => 'Etat vers : ' . $request->status,
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

    public function showStartRentalMachines()
    {
        $machines = Machine::where('rented', 0)
            ->where('status', 'Fonctionnelle')
            ->get();

        if (count($machines) == 0) {

            alert()->error('Aucune machine disponible', 'Oups!')->persistent('Fermer');
            return redirect()->back();
        }

        return view('Machine::startRentalGeneral', compact('machines'));

    }

}
