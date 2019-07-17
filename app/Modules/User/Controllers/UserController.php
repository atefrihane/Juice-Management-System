<?php

namespace App\Modules\User\Controllers;

use Alert;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Admin;
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

            alert()->success('Succés!', 'Bienvenue!');
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

    public function getUsers(){
        return User::query()->where('id','=',1)->with('child')->get();
    }

    public function storeClient($id, Request $request){
        switch ($request->type){
            case 'director' :
                $user = $request->all();
                unset($user['type'], $user['_token']);
                $director = Diractor::create(['company_id' => $id]);
                $user['child_type'] = Diractor::class;
                $user['child_id'] = $director->id;

               $user =  User::create($user);break;

            case 'supervisor' :
                $user = $request->all();
                unset($user['type'], $user['_token'], $user['stores']);

                $supervisor = SuperVisor::create([]);
                $user['child_type'] = SuperVisor::class;
                $user['child_id'] = $supervisor->id;
                $user =  User::create($user);
                foreach ($request->stores as $storeId){
                    Store::where('id',$storeId)->update(['super_visor_id' => $supervisor->id]);
                } break;
            case 'responsable' :
                $user = $request->all();
                unset($user['type'], $user['_token'],$user['store']);
                $responsable = Responsable::create(['store_id' => $request->store]);
                $user['child_type'] = Responsable::class;
                $user['child_id'] = $responsable->id;

                $user =  User::create($user);break;
        }
        return redirect(route('showContacts',$id));
    }

    public function edit($cid, $id){
        $company = Company::find($cid);
        $user = User::find($id);
        return view("User::editClient", compact('user','company'));
    }
    public function updateClient($cid,$id, Request $request){
        $user = $request->all();
        unset($user['_token']);
        if($user['password'] != '')
        $user['password'] = bcrypt($user['password']);
        else
            unset($user['password']);
        User::where('id', $id)->update($user);
        return redirect(route('showContacts', $cid));

    }

    public function deleteClient($cid, $id){
        $user = User::find($id);
        switch ($user->child_type){
            case Responsable::class : $responsable = Responsable::find($user->child_id);  $responsable->delete();break;
            case SuperVisor::class : $supervisor = SuperVisor::find($user->child_id);  $supervisor->delete();break;
            case Diractor::class : $director = Diractor::find($user->child_id);  $director->delete();break;
        }
        $user->delete();
        return redirect(route('showContacts', $cid));
    }

    public function detailClient($cid,$id){
        $user = User::find($id);
        $company = Company::find($cid);


        return view('User::detail', compact('user', 'company'));
    }
}
