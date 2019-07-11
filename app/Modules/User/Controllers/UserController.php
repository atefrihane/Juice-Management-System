<?php

namespace App\Modules\User\Controllers;

use Alert;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Admin;
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
}
