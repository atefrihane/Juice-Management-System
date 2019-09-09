<?php

namespace App\Modules\User\Controllers\api;

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

    public static function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('wize')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);

        }
    }

    public function detail(){

    }
}
