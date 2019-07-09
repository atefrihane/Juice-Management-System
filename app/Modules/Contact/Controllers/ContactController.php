<?php

namespace App\Modules\Contact\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;

class ContactController extends Controller
{

    public function showContacts($id)
    {
        $company = Company::find($id);
        if ($company) {
            return view('Contact::showContacts', compact('company'));
        }
        return view('General::notFound');
    }

    public function showAddContact($id)
    {
        $company = Company::find($id);
        if ($company) {
            return view('Contact::addContact', compact('company'));
        }
        return view('General::notFound');
    }

}
