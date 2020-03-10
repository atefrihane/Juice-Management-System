<?php

namespace App\Modules\User\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Admin;
use App\Modules\Company\Models\Company;
use App\Modules\General\Models\Advertisement;
use App\Modules\Store\Models\Store;
use App\Modules\User\Models\ContactHistory;
use App\Modules\User\Models\Director;
use App\Modules\User\Models\Responsible;
use App\Modules\User\Models\User;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public static function login(Request $request)
    {

        if (!$request->accessCode || !$request->password) {
            return response()->json(['status' => 404]);

        }
        $user = User::where([
            'accessCode' => $request->accessCode,
            'password' => $request->password,
        ])->first();

        if ($user) {
            if ($user->child_type == Admin::class) {
                $authorizedRoles = ['ADMIN', 'SUPERADMIN', 'DBO'];
                $role = $user->child->role->role_name;

                if (!in_array($role, $authorizedRoles)) {
                    return response()->json(['error' => 'UnAuthorised'], 401);
                }

            }

            $token = $user->createToken('wize')->accessToken;
            if ($user->getType() != 'admin') {
                $activeRentals = [];
                $company = null;
                switch ($user->getType()) {

                    case 'Directeur':
                        if ($user->child->store()->exists()) {
                            $activeRentals = Store::find($user->child->store->id)
                                ->whereHas('rentals', function ($q) {
                                    $q->where('active', 1);
                                })->with('rentals.machine', 'city.country', 'zipcode')
                                ->get();
                            $company = Company::find($user->child->store->company->id)->with('city.country', 'zipcode')->first();
                        }

                        return response()->json(['token' => $token,
                            'user' => $user,
                            'company' => $company,
                            'activeRentals' => $activeRentals,
                            'ads' => Advertisement::all(),
                            'userType' => $user->getType(),
                        ], 200);
                        break;
                    case 'Autre':

                        $company = Company::whereHas('stores', function ($q) use ($user) {
                            $q->whereIn('id', $user->child->stores->pluck('id'));
                        })
                            ->with('city.country', 'zipcode')
                            ->first();

                        $relatedStores = Store::whereHas('responsibles', function ($q) use ($user) {
                            $q->where('responsible_id', $user->child->id);
                        })->get();

                        if (!empty($relatedStores)) {
                            $activeRentals = Store::whereIn('id', $relatedStores->pluck('id'))
                                ->whereHas('rentals', function ($q) {
                                    $q->where('active', 1);
                                })->with('rentals.machine', 'city.country', 'zipcode')
                                ->get();
                        }

                        return response()->json([
                            'token' => $token,
                            'user' => $user,
                            'company' => $company,
                            'relatedStores' => $relatedStores,
                            'activeRentals' => $activeRentals,
                            'userType' => $user->getType(),
                            'ads' => Advertisement::all(),
                        ], 200);
                        break;
                }

            } else {
                //List all companies with stores for ADMINS
                return response()->json([
                    'token' => $token,
                    'user' => $user,
                    'userType' => $user->getType(),
                    'allCompanies' => Company::with('stores', 'city.country', 'zipcode')->get(),
                    'ads' => Advertisement::all(),

                ]
                    , 200);

            }

        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);

        }
    }
    public function handleFetchUser($id)
    {
        $checkUser = User::find($id);
        if ($checkUser) {
            return response()->json(['status' => 200, 'user' => $checkUser]);

        }

        return response()->json(['status' => 400]);

    }

    public function showUsers()
    {
        return response()->json(['status' => 200, 'users' => User::all()]);
    }
    public function storeClient($id, Request $request)
    {

        $checkCode = User::where('code', $request->code)->first();
        $checkAccessCode = User::where('accessCode', $request->accessCode)->first();
        if ($checkCode) {
            return response()->json(['status' => 400]);
        }
        if ($checkAccessCode) {
            return response()->json(['status' => 405]);
        }
        switch ($request->type) {

            case 1:

                $checkStore = Store::find($request->storeChecked);
                if ($checkStore) {
                    if ($checkStore->director) {
                        return response()->json(['status' => 401]);

                    }

                    $request->validate([
                        'code' => 'required|regex:/^[A-Z0-9]+$/|alpha_dash',
                        'phone' => 'required|digits_between:1,12',
                        'name' => 'required|max:150',
                        'surname' => 'required|max:150',
                        'accessCode' => 'required|max:150',
                        'passWord' => 'required|max:150',
                        'civility' => 'required',
                        'email' => 'required|email',

                    ], [
                        'code.required' => ' Code est obligatoire',
                        'code.regex' => ' Code n\'est pas valide',
                        'code.alpha_dash' => ' Code doit être alphanumérique',
                        'phone.required' => ' Numéro telephone est obligatoire',
                        'phone.digits_between' => ' Numéro telephone est invalide',
                        'name.required' => ' Nom est obligatoire',
                        'name.max' => ' Nom est invalide',
                        'surname.required' => ' Nom est obligatoire',
                        'surname.max' => ' Nom est invalide',
                        'accessCode.required' => ' Code d\'accés est obligatoire',
                        'accessCode.max' => ' Code d\'accés est invalide',
                        'passWord.required' => ' Mot de passe est obligatoire',
                        'passWord.max' => ' Mot de passe ne doit pas dépasser 150 caractères',

                    ]);

                    $director = Director::create(['comment' => $request->comment]);

                    $user = User::create([
                        'code' => $request->code,
                        'nom' => $request->name,
                        'prenom' => $request->surname,
                        'civilite' => $request->civility,
                        'email' => $request->email,
                        'telephone' => $request->phone,
                        'accessCode' => $request->accessCode,
                        'password' => $request->passWord,
                    ]);
                    $director->user()->save($user);

                    $checkStore->update(['director_id' => $director->id]);

                } else {
                    return response()->json(['status' => 404]);

                }

                break;

            case 2:

                $request->validate([
                    'code' => 'required|regex:/^[A-Z0-9]+$/|alpha_dash',
                    'phone' => 'required|digits_between:1,12',
                    'name' => 'required|max:150',
                    'surname' => 'required|max:150',
                    'accessCode' => 'required|max:150',
                    'passWord' => 'required|max:150',
                    'civility' => 'required',
                    'email' => 'required|email',

                ], [
                    'code.required' => ' Code est obligatoire',
                    'code.regex' => ' Code n\'est pas valide',
                    'code.alpha_dash' => ' Code doit être alphanumérique',
                    'phone.required' => ' Numéro telephone est obligatoire',
                    'phone.digits_between' => ' Numéro telephone est invalide',
                    'name.required' => ' Nom est obligatoire',
                    'name.max' => ' Nom est invalide',
                    'surname.required' => ' Nom est obligatoire',
                    'surname.max' => ' Nom est invalide',
                    'accessCode.required' => ' Code d\'accés est obligatoire',
                    'accessCode.max' => ' Code d\'accés est invalide',
                    'passWord.required' => ' Mot de passe est obligatoire',
                    'passWord.max' => ' Mot de passe ne doit pas dépasser 150 caractères',

                ]);

                $responsible = Responsible::create(['comment' => $request->comment]);

                $user = User::create([
                    'code' => $request->code,
                    'nom' => $request->name,
                    'prenom' => $request->surname,
                    'civilite' => $request->civility,
                    'email' => $request->email,
                    'telephone' => $request->phone,
                    'accessCode' => $request->accessCode,
                    'password' => $request->passWord,
                ]);

                $responsible->user()->save($user);
                $responsible->stores()->attach($request->storesChosen);

                break;
        }
        ContactHistory::create([
            'action' => 'Création',
            'contact_id' => $user->id,
            'user_id' => $request->user_id,
            'comment' => $request->comment,

        ]);
        return response()->json(['status' => 200]);

    }

    public function updateClient($cid, $id, Request $request)
    {

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
            $checkAccessCode = User::where('accessCode', $request->accessCode)
                ->where('id', '!=', $user->id)
                ->first();
            if ($checkCode) {
                return response()->json(['status' => 400]);
            }

            if ($checkAccessCode) {
                return response()->json(['status' => 406]);
            }
            switch ($user->getType()) {

                case 'Directeur':

                    // Directeur -> Autre
                    if ($request->input('type') == 2) {
                        $request->validate([
                            'code' => 'required|regex:/^[A-Z0-9]+$/|alpha_dash',
                            'phone' => 'required|digits_between:1,12',
                            'name' => 'required|max:150',
                            'surname' => 'required|max:150',
                            'accessCode' => 'required|max:150',
                            'passWord' => 'required|max:150',
                            'civility' => 'required',
                            'email' => 'required|email',

                        ], [
                            'code.required' => ' Code est obligatoire',
                            'code.regex' => ' Code n\'est pas valide',
                            'code.alpha_dash' => ' Code doit être alphanumérique',
                            'phone.required' => ' Numéro telephone est obligatoire',
                            'phone.digits_between' => ' Numéro telephone est invalide',
                            'name.required' => ' Nom est obligatoire',
                            'name.max' => ' Nom est invalide',
                            'surname.required' => ' Nom est obligatoire',
                            'surname.max' => ' Nom est invalide',
                            'accessCode.required' => ' Code d\'accés est obligatoire',
                            'accessCode.max' => ' Code d\'accés est invalide',
                            'passWord.required' => ' Mot de passe est obligatoire',
                            'passWord.max' => ' Mot de passe ne doit pas dépasser 150 caractères',

                        ]);

                        Director::find($user->child_id)->delete();

                        $newResponsible = Responsible::create(['comment' => $request->comment]);
                        $newResponsible->user()->save($user);
                        $newResponsible->stores()->attach($request->input('storesChosen'));

                    }
                    // Update Directeur
                    else {
                        $request->validate([
                            'code' => 'required|regex:/^[A-Z0-9]+$/|alpha_dash',
                            'phone' => 'required|digits_between:1,12',
                            'name' => 'required|max:150',
                            'surname' => 'required|max:150',
                            'accessCode' => 'required|max:150',
                            'passWord' => 'required|max:150',
                            'civility' => 'required',
                            'email' => 'required|email',

                        ], [
                            'code.required' => ' Code est obligatoire',
                            'code.regex' => ' Code n\'est pas valide',
                            'code.alpha_dash' => ' Code doit être alphanumérique',
                            'phone.required' => ' Numéro telephone est obligatoire',
                            'phone.digits_between' => ' Numéro telephone est invalide',
                            'name.required' => ' Nom est obligatoire',
                            'name.max' => ' Nom est invalide',
                            'surname.required' => ' Nom est obligatoire',
                            'surname.max' => ' Nom est invalide',
                            'accessCode.required' => ' Code d\'accés est obligatoire',
                            'accessCode.max' => ' Code d\'accés est invalide',
                            'passWord.required' => ' Mot de passe est obligatoire',
                            'passWord.max' => ' Mot de passe ne doit pas dépasser 150 caractères',

                        ]);

                        $checkStore = Store::find($request->storeChecked);

                        if ($checkStore) {
                            //Check if store had already a director
                            if ($checkStore->director_id && $checkStore->director_id != $user->child_id) {
                                return response()->json(['status' => 401]);

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
                            return response()->json(['status' => 404]);

                        }

                    }

                    break;

                case 'Autre':
                    $request->validate([
                        'code' => 'required|regex:/^[A-Z0-9]+$/|alpha_dash',
                        'phone' => 'required|digits_between:1,12',
                        'name' => 'required|max:150',
                        'surname' => 'required|max:150',
                        'accessCode' => 'required|max:150',
                        'passWord' => 'required|max:150',
                        'civility' => 'required',
                        'email' => 'required|email',

                    ], [
                        'code.required' => ' Code est obligatoire',
                        'code.regex' => ' Code n\'est pas valide',
                        'code.alpha_dash' => ' Code doit être alphanumérique',
                        'phone.required' => ' Numéro telephone est obligatoire',
                        'phone.digits_between' => ' Numéro telephone est invalide',
                        'name.required' => ' Nom est obligatoire',
                        'name.max' => ' Nom est invalide',
                        'surname.required' => ' Nom est obligatoire',
                        'surname.max' => ' Nom est invalide',
                        'accessCode.required' => ' Code d\'accés est obligatoire',
                        'accessCode.max' => ' Code d\'accés est invalide',
                        'passWord.required' => ' Mot de passe est obligatoire',
                        'passWord.max' => ' Mot de passe ne doit pas dépasser 150 caractères',

                    ]);

                    if ($user->child->stores()->exists()) {
                        // Autre -> Directeur
                        if ($request->input('storeChecked')) {

                            $checkStore = Store::find($request->storeChecked);
                            if ($checkStore) {
                                if ($checkStore->director_id) {
                                    return response()->json(['status' => 401]);

                                }

                                Responsible::find($user->child->id)->delete();
                                $newDirector = Director::create(['comment' => $request->comment]);
                                $newDirector->user()->save($user);
                                $checkStore->update(['director_id' => $newDirector->id]);

                            } else {
                                return response()->json(['status' => 404]);

                            }

                            // Update  Autre

                        } else {

                            // detach a related store from user

                            if ($user->child->stores->count() > count($request->input('oldStoresChosen'))) {
                                $userStoresIds = $user->child->stores->pluck('id')->toArray();
                                $detachedStores = array_diff($userStoresIds, $request->input('oldStoresChosen'));
                                DB::table('responsible_stores')
                                    ->where('responsible_id', $user->child_id)
                                    ->whereIn('store_id', $detachedStores)->delete();
                            }

                            $user->child->update(['comment' => $request->comment]);
                            try {

                                if ($request->input('freeStoresChosen')) {

                                    $user->child->stores()->attach($request->input('freeStoresChosen'));

                                }
                            } catch (\Exception $e) {
                                return response()->json(['status' => 405]);

                            }

                        }

                    }

                    break;

            }

            $user = User::where('id', $id)->update([
                'code' => $request->code,
                'nom' => $request->name,
                'prenom' => $request->surname,
                'civilite' => $request->civility,
                'email' => $request->email,
                'telephone' => $request->phone,
                'accessCode' => $request->accessCode,
                'password' => $request->passWord,
            ]);

            ContactHistory::create([
                'action' => 'Modification',
                'contact_id' => $id,
                'user_id' => $request->user_id,
                'comment' => $request->comment,

            ]);
            return response()->json(['status' => 200]);

        }
        return view('General::norFound');

    }

    public function showPreparators()
    {
        $preparators = Admin::with('user')->whereHas('role', function ($q) {
            $q->where('role_name', '<>', 'MAIN_DELIVERY');
            $q->where('role_name', '<>', 'SECOND_DELIVERY');
        })->get();
        return response()->json(['status' => 200, 'preparators' => $preparators]);
    }

    public function showDeliveries()
    {
        $deliveries = Admin::with('user')->whereHas('role', function ($q) {
            $q->where('role_name', 'MAIN_DELIVERY');
            $q->orwhere('role_name', 'SECOND_DELIVERY');
        })->get();

        return response()->json(['status' => 200, 'deliveries' => $deliveries]);
    }

    public function showResponsibleStores($id)
    {
        $checkUser = User::find($id);
        if ($checkUser) {
            $relatedStores = Store::whereHas('responsibles', function ($q) use ($checkUser) {
                $q->where('responsible_id', $checkUser->child->id);
            })->get();
            return response()->json(['status' => 200, 'relatedStores' => $relatedStores]);

        }
        return response()->json(['status' => 404, 'User' => 'User not found']);

    }
}
