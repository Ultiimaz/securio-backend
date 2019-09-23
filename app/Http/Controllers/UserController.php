<?php

namespace App\Http\Controllers;

use App\Administration;
use App\AdministrationRelation;
use App\Http\Requests\AuthenticationRequest;
use App\Provider;
use App\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{


    public function authenticateWithPassword(AuthenticationRequest $request)
    {

        $credentials = $request;
        $provider = Provider::where(function($query) use($credentials)
        {
            $query->where('provider_name','password');
            $query->where('email',$credentials->email);
        })->get()->first();

        if(!Hash::check($credentials->password,$provider->password))
        {
            throw new AuthenticationException();
        }
        if(!empty($provider))
        {
           return  User::where('id',$provider->user_id)->get()->first()->createToken("dfgdfg")->accessToken;
        }
        else{
            throw new AuthenticationException();
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
