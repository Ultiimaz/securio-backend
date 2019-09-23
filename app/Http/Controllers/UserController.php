<?php

namespace App\Http\Controllers;

use App\Administration;
use App\AdministrationRelation;
use App\Http\Requests\AuthenticationRequest;
use App\Provider;
use App\User;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class UserController extends Controller
{


    public function authenticateWithPassword(AuthenticationRequest $request)
    {

        $provider = Provider::where(function($query) use($request)
        {
            $query->where('provider_name','password');
            $query->where('email',$request->email);
        })->get()->first();
        if(!$provider)

            return ['status' => 'error','error' => 'authentication_error'];
//            throw new Exception("invalid login");

        if(!Hash::check($request->password,$provider->password))
        {
            return ['status' => 'error','error' => 'authentication_error'];
        }
        if(!empty($provider))
        {
           return ['token' =>User::where('id',$provider->user_id)->get()->first()->createToken("dfgdfg")->accessToken];
        }
        else{
            return ['status' => 'error','error' => 'authentication_error'];
        }

    }
    public function setMasterPassword(Request $request){
        $user = Auth::user();
        $user->master_password = $request->password;
        $user->save();
    }
    public function logout(){

    }

}
