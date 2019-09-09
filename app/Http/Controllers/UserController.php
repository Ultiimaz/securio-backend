<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{


    public function authenticate(Request $request)
    {
       $user = new User;
       $user->fill($request->toArray());

    }
    function createUser($getInfo){
        $user = User::Where('provider_id', $getInfo->id)->first();
        if (!$user) {
            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'provider' => "facebook",
                'provider_id' => $getInfo->id
            ]);
        }
        return $user;
    }
    public function setMasterPassword(Request $request){
        $user = Auth::user();
        $user->master_password = $request->password;
        $user->save();
    }
    public function logout(){

    }
}
