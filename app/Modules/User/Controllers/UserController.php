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
use DB;
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

    public function storeClient($id, Request $request)
    {

        $rules = [
            'code' => 'required',
            'nom' => 'required',
            'prenom' => 'required',
            'civilite' => 'required',
            'telephone' => 'required',
            // 'email' => 'required|email',
            'accessCode' => 'required',
            'passWord' => 'required',
        ];
        $messages = [
            'code.required' => 'le champs code est obligatoire',
            'nom.required' => 'le champs nom est obligatoire',
            'prenom.required' => 'le champs prenom est obligatoire',
            'civilite.required' => 'le champs civilite est obligatoire',
            'telephone.required' => 'le champs telephone est obligatoire',
            // 'email.required' => 'le champs email est obligatoire',
            // 'email.email' => 'vous devez saisir un email valide ',
            'accessCode.required' => 'le champs code d\'acces est obligatoire',
            'passWord.required' => 'le champs mot de passe est obligatoire',

        ];

        // $checkEmail = User::where('email', $request->email)->first();
        // if ($checkEmail) {
        //     alert()->error('Oups', 'Email déja existant !')->persistent('Fermer');
        //     return redirect()->back()->withInput();
        // }

        $checkCode = User::where('code', $request->code)->first();
        if ($checkCode) {
            alert()->error('Oups', 'Code déja existant !')->persistent('Fermer');
            return redirect()->back()->withInput();
        }
        switch ($request->type) {

            case 'director':

                $user = $request->all();

                $checkStore = Store::find($request->store);
                if ($checkStore) {
                    if ($checkStore->director) {
                        alert()->error(ucfirst($checkStore->designation) . ' a déja un directeur !', 'Oups!')->persistent("Fermer");
                        return redirect()->back()->withInput();

                    }

                    $rules['store'] = 'required';
                    $messages['store.required'] = 'Séléctionner  un magasin';
                    $val = $request->validate($rules, $messages);
                    $director = Director::create(['comment' => $request->comment]);

                    $user = User::create([
                        'code' => $request->code,
                        'nom' => $request->nom,
                        'prenom' => $request->prenom,
                        'civilite' => $request->civilite,
                        'email' => $request->email,
                        'telephone' => $request->telephone,
                        'accessCode' => $request->accessCode,
                        'password' => $request->passWord,
                    ]);
                    $director->user()->save($user);

                    $checkStore->update(['director_id' => $director->id]);

                } else {
                    alert()->error('Oups!', 'Magasin introuvable')->persistent("Fermer");
                    return redirect()->back()->withInput();

                }

                break;

            case 'responsible':
                $user = $request->all();

                $rules['stores'] = 'required';
                $messages['stores.required'] = 'Séléctionner au moins un magasin';
                $val = $request->validate($rules, $messages);

                $responsible = Responsible::create(['comment' => $request->comment]);

                $user = User::create([
                    'code' => $request->code,
                    'nom' => $request->nom,
                    'civilite' => $request->civilite,
                    'email' => $request->email,
                    'telephone' => $request->telephone,
                    'accessCode' => $request->accessCode,
                    'password' => $request->passWord,
                ]);

                $responsible->user()->save($user);
                foreach ($request->stores as $store) {
                    $responsible->stores()->attach($store);
                }

                break;
        }
        alert()->success('Succès!', 'Le contact a été ajouté avec succès!')->persistent("Fermer");

        return redirect(route('showContacts', $id));
    }

    public function edit($cid, $id)
    {

        $company = Company::find($cid);
        $user = User::find($id);
        $freeStores = [];
        if ($user->getType() == 'Autre') {

            $storedIds = $user->child->stores()->pluck('stores.id')->toArray();

            $freeStores = Store::whereNotIn('id', $storedIds)
                ->get();

        }

        return view("User::editClient", compact('user', 'company', 'freeStores'));

    }
    public function updateClient($cid, $id, Request $request)
    {

        $val = $request->validate([
            'code' => 'required',
            'nom' => 'required',
            'prenom' => 'required',
            'civilite' => 'required',
            'telephone' => 'required',
            // 'email' => 'required|email',
            'accessCode' => 'required',
        ], [
            'code.required' => 'le champs code est obligatoire',
            'nom.required' => 'le champs nom est obligatoire',
            'prenom.required' => 'le champs prenom est obligatoire',
            'civilite.required' => 'le champs sexe est obligatoire',
            'telephone.required' => 'le champs telephone est obligatoire',
            // 'email.required' => 'le champs email est obligatoire',
            // 'email.email' => 'vous devez saisir un email valide ',
            'accessCode.required' => 'le champs code d\'acces est obligatoire',

        ]);

        //check old stores for supervisor && affect new ones
        $user = User::find($id);
        if ($user) {
            // $checkEmail = User::where('email', $request->email)
            //     ->where('id', '!=', $user->id)
            //     ->first();
            // if ($checkEmail) {
            //     alert()->error('Oups', 'Email déja existant !')->persistent('Fermer');
            //     return redirect()->back()->withInput();
            // }

            $checkCode = User::where('code', $request->code)
                ->where('id', '!=', $user->id)
                ->first();
            if ($checkCode) {
                alert()->error('Oups', 'Code déja existant !')->persistent('Fermer');
                return redirect()->back()->withInput();
            }
            switch ($user->getType()) {

                case 'Directeur':
                    // Directeur -> Autre
                    if ($request->input('directorHidden')) {

                        Director::find($user->child_id)->delete();

                        $newResponsible = Responsible::create(['comment' => $request->comment]);
                        $newResponsible->user()->save($user);
                        $newResponsible->stores()->attach($request->input('directorHidden'));

                    }
                    // Update Directeur
                    else {
                    
                        $checkStore = Store::find($request->store);

                        if ($checkStore) {
                            //Check if store had already a director
                            if ($checkStore->director_id && $checkStore->director_id != $user->child_id) {
                                alert()->error('Ce magasin a déja un directeur', 'Oups!')->persistent('Femer');
                                return redirect()->back()->withInput();

                            }
                            //Check if director's store is not his current one in order to update it
                            if ($user->child->store->id != $checkStore->id) {
                                $oldStore = Store::where('director_id', $user->child_id)->first();

                                if ($oldStore) {
                                    $oldStore->update(['director_id' => null]);

                                    $checkStore->update(['director_id' => $user->child_id]);
                                }

                            }

                            $user->child->update(['comment' => $request->comment]);

                        } else {
                            alert()->error('Magasin n\'est plus disponible !', 'Oups!')->persistent('Femer');
                            return redirect()->back()->withInput();

                        }

                    }

                    break;

                case 'Autre':

                    if ($user->child->stores()->exists()) {
                        // Autre -> Directeur
                        if ($request->input('responsableHidden')) {

                            $checkStore = Store::find($request->responsableHidden);
                            if ($checkStore) {
                                if ($checkStore->director_id) {
                                    alert()->error('Ce magasin a déja un directeur!', 'Oups!')->persistent('Fermer');
                                    return redirect()->back()->withInput();

                                }

                                Responsible::find($user->child->id)->delete();
                                $newDirector = Director::create(['comment' => $request->comment]);
                                $newDirector->user()->save($user);
                                $checkStore->update(['director_id' => $newDirector->id]);

                            } else {
                                alert()->error('Magasin nn\'est plus disponible', 'Oups')->persistent('Fermer');
                                return redirect()->back();

                            }

                            // Update  Autre

                        } else {

                            if (!$request->input('stores')) {
                                alert()->error('Veuillez séléctionner au moins un magasin', 'Oups!')->persistent('Femer');
                                return redirect()->back()->withInput();
                            }
                            // detach a related store from user
                            if ($user->child->stores->count() > count($request->input('stores'))) {
                                if (!in_array($user->child->stores->pluck('id'), $request->input('stores'))) {

                                    DB::table('responsible_stores')->whereIn('store_id', $request->input('stores'))->delete();
                                }

                            }
                            $user->child->update(['comment' => $request->comment]);

                        }

                    }

                    try {

                        if ($request->input('newStores')) {

                            $user->child->stores()->attach($request->input('newStores'));

                        }
                    } catch (\Exception $e) {
                        alert()->error('Magasin non disponible', 'Oups')->persistent('Fermer');
                        return redirect()->back();

                    }

                    break;

            }

            $user = $request->all();

            unset($user['_token']);
            unset($user['stores']);
            unset($user['newStores']);
            unset($user['store']);
            unset($user['type']);
            unset($user['storesHidden']);
            unset($user['responsableHidden']);
            unset($user['directorHidden']);
            unset($user['comment']);

            User::where('id', $id)->update($user);
            alert()->success('Succés', 'Contact modifié avec succés!')->persistent('Fermer');
            return redirect(route('showContacts', $cid));

        }
        return view('General::norFound');

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

    public function detailClient($cid, $id)
    {

        $user = User::find($id);
        if ($user) {
            $type = $user->getType();
            switch ($type) {

                case ('responsable'):
                    $company = Company::find($cid);
                    $store = $user->child->store;
                    return view('User::detail', compact('user', 'company', 'store'));

                    break;

                case ('superviseur'):
                    $company = Company::find($cid);
                    $supervisorId = $user->child->id;
                    $supervisor = SuperVisor::find($supervisorId);
                    if ($supervisor) {
                        $store = Store::where('super_visor_id', $supervisor->id)->first();
                    }
                    return view('User::detail', compact('user', 'company', 'store'));

                    break;

                case ('directeur'):
                    $company = Company::find($cid);
                    return view('User::detail', compact('user', 'company'));
                    break;
            }

        }

        return view('General::notFound');

    }
}
