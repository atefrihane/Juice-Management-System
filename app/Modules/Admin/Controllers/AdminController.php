<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Admin;
use App\Modules\Order\Models\Order;
use App\Modules\Order\Models\OrderHistory;
use App\Modules\Role\Models\Role;
use App\Modules\User\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::with('user', 'role')->whereHas('role', function ($q) {
            $q->where('role_name', '<>', 'DBO');
        })->get();
        return view("Admin::index", compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::all();
        $lastAdminId = Admin::all()->last()->id + 1;
        return view('Admin::addAdmin', compact("roles", "lastAdminId"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $val = $request->validate([
            'code' => 'required|regex:/^[A-Z0-9]+$/|alpha_dash',
            'nom' => 'required',
            'prenom' => 'required',
            'sexe' => 'required',
            'telephone' => 'required|digits_between:1,12',
            'email' => 'required|email|',
            'accessCode' => 'required',
            'passWord' => 'required',
        ], [
            'code.required' => ' Code est obligatoire',
            'code.regex' => ' Code n\'est pas valide',
            'nom.required' => ' Nom est obligatoire',
            'prenom.required' => ' Prenom est obligatoire',
            'sexe.required' => ' Civilite est obligatoire',
            'telephone.required' => ' Télephone est obligatoire',
            'telephone.digits_between' => 'Téléphone est invalide',
            'email.required' => ' Email est obligatoire',
            'email.email' => 'Vous devez saisir un email valide ',
            'accessCode.required' => ' Code d\'acces est obligatoire',
            'passWord.required' => ' Mot de passe est obligatoire',

        ]);
        $checkCode = User::where('code', $request->code)->first();
        if ($checkCode) {
            alert()->error('Code existe déja', 'Oups!')->persistent('Fermer');
            return redirect()->back()->withInput();
        }
        $checkAccessCode = User::where('accessCode', $request->accessCode)->first();
        if ($checkAccessCode) {
            alert()->error('Ce code d\'accés existe déja', 'Oups!')->persistent('Fermer');
            return redirect()->back()->withInput();
        }

        $admin = Admin::create([
            'role_id' => $request->role,
        ]);
        $user = User::create([
            'email' => $request->email,
            'code' => $request->code,
            'nom' => ucfirst($request->nom),
            'prenom' => ucfirst($request->prenom),
            'civilite' => $request->sexe,
            'telephone' => $request->telephone,
            'accessCode' => $request->accessCode,
            'password' => $request->passWord,
            'child_type' => Admin::class,
            'child_id' => $admin->id,
        ]);
        alert()->success('Succès!', 'Admin ajouté avec succès')->persistent('Fermer');
        return redirect('/admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $admin = Admin::query()->where('id', '=', $id)->with('user')->get()->first();
        $roles = Role::all();
        if (!$admin) {
            return view('General::notFound');
        }
        return view("Admin::updateAdmin", compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $val = $request->validate([
            'code' => 'required|regex:/^[A-Z0-9]+$/|alpha_dash',
            'nom' => 'required',
            'prenom' => 'required',
            'sexe' => 'required',
            'telephone' => 'required|digits_between:1,12',
            'email' => 'required|email|',
            'accessCode' => 'required',
            'passWord' => 'required',
        ], [
            'code.required' => ' Code est obligatoire',
            'code.regex' => ' Code n\'est pas valide',
            'nom.required' => ' Nom est obligatoire',
            'prenom.required' => ' Prenom est obligatoire',
            'sexe.required' => ' Civilite est obligatoire',
            'telephone.required' => ' Télephone est obligatoire',
            'telephone.digits_between' => 'Téléphone est invalide',
            'email.required' => ' Email est obligatoire',
            'email.email' => 'Vous devez saisir un email valide ',
            'accessCode.required' => ' Code d\'acces est obligatoire',
            'passWord.required' => ' Mot de passe est obligatoire',

        ]);
        $admin = Admin::find($id);
        if (!$admin) {
            return view('General::notFound');
        }

        $checkCode = User::where('code', $request->code)
            ->where('id', '<>', $admin->user->id)
            ->first();
        if ($checkCode) {
            alert()->error('Code existe déja', 'Oups!')->persistent('Fermer');
            return redirect()->back()->withInput();
        }
        $checkAccessCode = User::where('accessCode', $request->accessCode)
            ->where('id', '<>', $admin->user->id)
            ->first();
        if ($checkAccessCode) {
            alert()->error('Ce code d\'accés existe déja', 'Oups!')->persistent('Fermer');
            return redirect()->back()->withInput();
        }

        $user = User::find($admin->user->id);
        if ($request->passWord != null) {
            $password = $request->passWord;
        } else {
            $password = $user->password;
        }

        User::where('id', '=', $admin->user->id)->update([
            'email' => $request->email,
            'code' => $request->code,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'civilite' => $request->sexe,
            'telephone' => $request->telephone,
            'accessCode' => $request->accessCode,
            'password' => $password,
            'child_type' => Admin::class,
            'child_id' => $id,
        ]);
        $user = Admin::find($id)->user;
        alert()->success('Compte modifié avec succès', 'Succès! ')->persistent('Fermer');
        return redirect('/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);
        if ($admin) {
            $user = $admin->user;

            $checkOrders = Order::where('delivery_man_id', $user->id)
                ->orwhere('preparator_id', $user->id)
                ->first();
            $checkHistory = OrderHistory::where('user_id', $user->id)
                ->where('action', 'Création')
                ->first();

            if ($checkHistory or $checkOrders) {
                alert()->error('Cette entité ne peut pas être supprimée, autres entités y sont liées', 'Oups! ')->persistent("Fermer");
                return redirect()->back();
            }

            if ($admin->role->id != 1) {$admin->delete();
                $user->delete();

            }
            alert()->success('Succès!', 'Admin supprimé avec succès')->persistent('Fermer');
            return redirect('/admin');

        }
        return view('General::notFound');

    }
}
