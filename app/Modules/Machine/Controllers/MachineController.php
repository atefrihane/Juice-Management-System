<?php

namespace App\Modules\Machine\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;
class MachineController extends Controller
{
    public function showMachines()
    {

        return view('Machine::showMachines');

    }

    public function showAddMachine()
    {

        return view('Machine::addMachine');

    }

    public function showRentedMachines($id)
    {
        $company = Company::find($id);
        if ($company) {
            return view('Machine::showRentedMachines', compact('company'));
        }
        return view('General::notFound');

    }

}
