<?php

namespace App\Modules\User\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\Store\Models\Store;
use App\Modules\User\Models\Director;
use App\Modules\User\Models\Responsible;
use App\Modules\User\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public static function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('wize')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);

        }
    }

    public function showUsers()
    {
        return response()->json(['status' => 200, 'users' => User::all()]);
    }
    public function storeClient($id, Request $request)
    {

        $checkCode = User::where('code', $request->code)->first();
        if ($checkCode) {
            return response()->json(['status' => 400]);
        }
        switch ($request->type) {

            case 1:

                $checkStore = Store::find($request->storeChecked);
                if ($checkStore) {
                    if ($checkStore->director) {
                        return response()->json(['status' => 401]);

                    }

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
            if ($checkCode) {
                return response()->json(['status' => 400]);
            }
            switch ($user->getType()) {

                case 'Directeur':

                    // Directeur -> Autre
                    if ($request->input('type') == 2) {

                        Director::find($user->child_id)->delete();

                        $newResponsible = Responsible::create(['comment' => $request->comment]);
                        $newResponsible->user()->save($user);
                        $newResponsible->stores()->attach($request->input('storesChosen'));

                    }
                    // Update Directeur
                    else {

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
                                ->where('responsible_id',$user->child_id)
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

            User::where('id', $id)->update([
                'code' => $request->code,
                'nom' => $request->name,
                'prenom' => $request->surname,
                'civilite' => $request->civility,
                'email' => $request->email,
                'telephone' => $request->phone,
                'accessCode' => $request->accessCode,
                'password' => $request->passWord,
            ]);
            return response()->json(['status' => 200]);

        }
        return view('General::norFound');

    }
}
