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
        if(!$request->has('user_token'))
        {
            return [
                'status' => 'error',
                'message' => 'no message provided'
            ];
        }
        $getInfo = Socialite::driver("facebook")->stateless()->userFromToken($request->user_token);
        $user = $this->createUser($getInfo);
        auth()->login($user);
        return ['status' => 'success',$user];
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
