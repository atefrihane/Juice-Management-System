<?php

namespace App\Modules\User\Controllers;

use Alert;
use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;
use App\Modules\Store\Models\Store;
use App\Modules\User\Models\Director;
use App\Modules\User\Models\Responsible;
use App\Modules\User\Models\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function showLogin()
    {

        return view('General::login');
    }

    public function handleLogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            Auth::user();
            return redirect()->route('showHome');

        } else {
            alert()->error('Oups!', 'Email ou Mot de passe incorrect !');
            return redirect()->back();
        }

    }

    public function handleSignOut()
    {
        Auth::logout();
        return redirect()->route('showLogin');
    }

    public function showContacts($id)
    {

        $company = Company::find($id);
        $contacts = [];
        if ($company) {
            if ($company->stores()->exists()) {

                $directors = Director::whereIn('id', $company->stores->pluck('director_id'))->get();
                $responsibles = Responsible::whereHas('stores', function ($q) use ($company) {
                    $q->whereIn('store_id', $company->stores->pluck('id'));
                })->get();

                $contacts = $directors->toBase()->merge($responsibles);
               
            }
          

            return view('User::showClients', compact('company', 'contacts'));

        }

        return view('General::notFound');
    }

    public function showAddContact($id)
    {

        $company = Company::find($id);

        if ($company) {

            return view('User::addClient', compact('company'));
        }
        return view('General::notFound');
    }

    public function getUsers()
    {
        return User::query()->where('id', '=', 1)->with('child')->get();
    }

    public function edit($cid, $id)
    {

        $company = Company::find($cid);
        $user = User::with('child')->where('id', $id)->first();
        $relatedData = [];
        $freeStores = [];
        if ($user) {
            if ($user->getType() == 'Directeur') {
                $relatedData = $user->child->store;
                $type = 1;

            } else {
                $relatedData = $user->child->stores;
                $freeStores = Store::whereNotIn('id', $user->child->stores->pluck('id'))->get();
                $type = 2;

            }

        }

        return view("User::editClient", compact('user', 'company', 'relatedData', 'type', 'freeStores'));

    }

    public function deleteClient($cid, $id)
    {

        $user = User::find($id);

        switch ($user->child_type) {

            case Director::class:

                $director = Director::find($user->child_id)->delete();
                break;
            case Responsible::class:
                $responsible = Responsible::find($user->child_id)->delete();
                break;
        }
        $user->delete();
        alert()->success('Succès', ' Le contact a été supprimé avec succès !')->persistent('Fermer');
        return redirect(route('showContacts', $cid));
    }

    public function showContact($cid, $id)
    {
      
        $user = User::find($id);
 
        $company = Company::find($cid);

        if ($user && $company) {
            $contacts = $company->contacts($user);
            if ($contacts) {
                return view('User::detail', compact('user', 'company'));

            }
            return view('General::notFound');

        }

        return view('General::notFound');

    }
}
