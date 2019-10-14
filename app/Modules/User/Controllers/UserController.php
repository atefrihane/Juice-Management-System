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
            'password' => 'required',
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
            'password.required' => 'le champs mot de passe est obligatoire',

        ];

        switch ($request->type) {
            case 'director':
                $user = $request->all();
                $checkDirector = Diractor::where('company_id', $id)->first();
                if ($checkDirector) {
                    alert()->error('Oups!', 'La societé a déja un directeur')->persistent("Fermer");
                    return redirect()->back()->withInput();
                }
                unset($user['type'], $user['_token']);
                $val = $request->validate($rules, $messages);
                $director = Diractor::create(['company_id' => $id, 'comment' => $request->comment]);
                $user['child_type'] = Diractor::class;
                $user['child_id'] = $director->id;
                $user['password'] = bcrypt($user['password']);
                $user = User::create($user);
                break;

            case 'supervisor':
                $user = $request->all();
                foreach ($request->stores as $store) {
                    $checkStore = Store::find($store);
                    if ($checkStore->supervisor) {
                        alert()->error('Oups!', ucfirst($checkStore->designation) . ' a déja un superviseur')->persistent("Fermer");
                        return redirect()->back()->withInput();

                    }
                }
                unset($user['type'], $user['_token'], $user['stores']);
                $rules['stores'] = 'required';
                $messages['stores.required'] = 'selectionner au moin un magasin pour le superviseur';
                $val = $request->validate($rules, $messages);
                $supervisor = SuperVisor::create(['comment' => $request->comment]);
                $user['child_type'] = SuperVisor::class;
                $user['child_id'] = $supervisor->id;
                $user['password'] = bcrypt($user['password']);

                $user = User::create($user);
                foreach ($request->stores as $storeId) {
                    Store::where('id', $storeId)->update(['super_visor_id' => $supervisor->id]);
                }break;
            case 'responsable':
                $user = $request->all();
                $rules['store'] = 'required';
                $messages['store.required'] = 'selectionner un magasin pour le responsable';
                $val = $request->validate($rules, $messages);
                unset($user['type'], $user['_token'], $user['store']);
                $responsable = Responsable::create(['store_id' => $request->store, 'comment' => $request->comment]);
                $user['child_type'] = Responsable::class;
                $user['child_id'] = $responsable->id;
                $user['password'] = bcrypt($user['password']);

                $user = User::create($user);
                break;
        }
        alert()->success('Succès!', 'Le contact a été ajouté avec succès!')->persistent("Fermer");
        return redirect(route('showContacts', $id));
    }

    public function edit($cid, $id)
    {
        $company = Company::find($cid);
        $user = User::find($id);
        return view("User::editClient", compact('user', 'company'));
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

        $user = $request->all();
        unset($user['_token']);
        if ($user['password'] != '') {
            $user['password'] = bcrypt($user['password']);
        } else {
            unset($user['password']);
        }

        User::where('id', $id)->update($user);
        return redirect(route('showContacts', $cid));

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
        alert()->success('Succès', ' Le contact a été supprimé avec succès !');
        return redirect(route('showContacts', $cid));
    }

    public function detailClient($cid, $id)
    {
        $user = User::find($id);
        $company = Company::find($cid);

        return view('User::detail', compact('user', 'company'));
    }
}
