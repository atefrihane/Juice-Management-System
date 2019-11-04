<?php

namespace App\Modules\User\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\User\Models\User;
use Auth;
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
}
