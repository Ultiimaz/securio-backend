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
use Ramsey\Uuid\Uuid;


class UserController extends Controller
{
    public function registerWithPassword(Request $request)
    {
        $uuid = \Webpatser\Uuid\Uuid::generate()->string;
        $user_id = \Webpatser\Uuid\Uuid::generate()->string;
        $provider =  new Provider;
        $provider->fill($request->toArray());
        $provider->id = $uuid;
        $provider->provider_name = 'password';
        $provider->password = Hash::make($request->password);

        $user = new User;
        $user->id = $user_id;
        $user->fill($request->toArray());
        $user->provider_id = $uuid;
        $user->save();
        $provider->user_id = $user_id;
        $provider->save();
    }

    public function authenticateWithPassword(AuthenticationRequest $request)
    {

        $provider = Provider::where(function($query) use($request)
        {
            $query->where('provider_name','password');
            $query->where('email',$request->email);
        })->get()->first();
        if(!$provider)

            return response()->json([
                'status' => 'error',
                'error' => 'no_provider_found'
            ],403);
//            throw new Exception("invalid login");

        if(!Hash::check($request->password,$provider->password))
        {
            return response()->json([
                'status' => 'error',
                'error' => 'authentication_error'
            ],403);
        }
        if(!empty($provider))
        {
           return [
               'token' =>User::where('id',$provider->user_id)->get()->first()->createToken("dfgdfg")->accessToken
           ];
        }
        else{
            return response()->json([
                'status' => 'error',
                'error' => 'authentication_error'
            ],403);
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

