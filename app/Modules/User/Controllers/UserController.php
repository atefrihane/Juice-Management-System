<?php

namespace App\Modules\User\Controllers;

use Alert;
use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;
use App\Modules\Diractor\Models\Diractor;
use App\Modules\Responsable\Models\Responsable;
use App\Modules\Store\Models\Store;
use App\Modules\SuperVisor\Models\SuperVisor;
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
            'email' => 'required|email',
            'accessCode' => 'required',
            'passWord' => 'required',
        ];
        $messages = [
            'code.required' => 'le champs code est obligatoire',
            'nom.required' => 'le champs nom est obligatoire',
            'prenom.required' => 'le champs prenom est obligatoire',
            'civilite.required' => 'le champs civilite est obligatoire',
            'telephone.required' => 'le champs telephone est obligatoire',
            'email.required' => 'le champs email est obligatoire',
            'email.email' => 'vous devez saisir un email valide ',
            'accessCode.required' => 'le champs code d\'acces est obligatoire',
            'passWord.required' => 'le champs mot de passe est obligatoire',

        ];

        $checkEmail = User::where('email', $request->email)->first();
        if ($checkEmail) {
            alert()->error('Oups', 'Email déja existant !')->persistent('Fermer');
            return redirect()->back()->withInput();
        }

        $checkCode = User::where('code', $request->code)->first();
        if ($checkCode) {
            alert()->error('Oups', 'Code déja existant !')->persistent('Fermer');
            return redirect()->back()->withInput();
        }
        switch ($request->type) {

            case 'supervisor':
                $user = $request->all();
                foreach ($request->stores as $store) {
                    $checkStore = Store::find($store);
                    if ($checkStore->supervisor) {
                        alert()->error('Oups!', ucfirst($checkStore->designation) . ' a déja un superviseur')->persistent("Fermer");
                        return redirect()->back()->withInput();

                    }
                }

                $rules['stores'] = 'required';
                $messages['stores.required'] = 'selectionner au moin un magasin pour le superviseur';
                $val = $request->validate($rules, $messages);
                $supervisor = SuperVisor::create(['comment' => $request->comment]);

                $user = User::create([
                    'code' => $request->code,
                    'nom' => $request->nom,
                    'civilite' => $request->civilite,
                    'email' => $request->email,
                    'telephone' => $request->telephone,
                    'accessCode' => $request->accessCode,
                    'password' => $request->passWord,
                    'child_type' => SuperVisor::class,
                    'child_id' => $supervisor->id,
                ]);

                foreach ($request->stores as $storeId) {
                    Store::where('id', $storeId)->update(['super_visor_id' => $supervisor->id]);
                }

                break;

            case 'responsable':
                $user = $request->all();
                $rules['store'] = 'required';
                $messages['store.required'] = 'selectionner un magasin pour le responsable';
                $val = $request->validate($rules, $messages);

                $responsable = Responsable::create(['store_id' => $request->store, 'comment' => $request->comment]);

                $user = User::create([
                    'code' => $request->code,
                    'nom' => $request->nom,
                    'civilite' => $request->civilite,
                    'email' => $request->email,
                    'telephone' => $request->telephone,
                    'accessCode' => $request->accessCode,
                    'password' => $request->passWord,
                    'child_type' => Responsable::class,
                    'child_id' => $responsable->id,
                ]);
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
        if ($user->getType() == 'superviseur') {
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
            'email' => 'required|email',
            'accessCode' => 'required',
        ], [
            'code.required' => 'le champs code est obligatoire',
            'nom.required' => 'le champs nom est obligatoire',
            'prenom.required' => 'le champs prenom est obligatoire',
            'civilite.required' => 'le champs sexe est obligatoire',
            'telephone.required' => 'le champs telephone est obligatoire',
            'email.required' => 'le champs email est obligatoire',
            'email.email' => 'vous devez saisir un email valide ',
            'accessCode.required' => 'le champs code d\'acces est obligatoire',

        ]);

        //check old stores for supervisor && affect new ones
        $user = User::find($id);
        if ($user) {
            $checkEmail = User::where('email', $request->email)
                ->where('id', '!=', $user->id)
                ->first();
            if ($checkEmail) {
                alert()->error('Oups', 'Email déja existant !')->persistent('Fermer');
                return redirect()->back()->withInput();
            }

            $checkCode = User::where('code', $request->code)
                ->where('id', '!=', $user->id)
                ->first();
            if ($checkCode) {
                alert()->error('Oups', 'Code déja existant !')->persistent('Fermer');
                return redirect()->back()->withInput();
            }
            switch ($user->getType()) {

                case 'superviseur':
                    if ($user->child->stores()->exists()) {
                        if ($request->input('stores')) {
                            foreach ($user->child->stores as $store) {
                                if (!in_array($store->id, $request->input('stores'))) {
                                    $updateStore = Store::find($store->id);
                                    if ($updateStore) {
                                        $updateStore->update(['super_visor_id' => null]);

                                    }

                                }

                            }

                        } else {
                            // if old stores are empty

                            alert()->error('Vous devez affécter au moins un magasin!', 'Oups!')->persistent('Femer');
                            return redirect()->back();
                        }

                    }

                    if ($request->input('newStores')) {
                        foreach ($request->input('newStores') as $newStore) {
                            $updateStore = Store::find($newStore);
                            $updateStore->update(['super_visor_id' => $user->child->id]);

                        }
                    }

                    break;

                case 'responsable':
       
                    if ($request->input('storesHidden')) {
                        $user->child->delete();
                        $newSupervisor=SuperVisor::create(['comment' => null]);
                        $newSupervisor->user()->save($user);
            
                   
                        $user->update([
                            'child_type'=>SuperVisor::class,
                            'child_id'=>$newSupervisor->id
                        ]);
                      

                        foreach($request->input('storesHidden') as $storeId)
                        {
                            $updateStore = Store::find($storeId);
                            $updateStore->update(['super_visor_id' => $newSupervisor->id]);

                        }
                    

                        

                    } else {
                        $user->child->update(['store_id' => $request->store]);

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
            case Responsable::class:$responsable = Responsable::find($user->child_id);
                $responsable->delete();
                break;
            case SuperVisor::class:$supervisor = SuperVisor::find($user->child_id);
                $supervisor->delete();
                break;
            case Diractor::class:$director = Diractor::find($user->child_id);
                $director->delete();
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
