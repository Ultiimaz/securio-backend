<?php

use Illuminate\Http\Request;
Route::post('authenticate','UserController@authenticateWithPassword');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    $administrations = [];
    foreach($request->user()->administrations as $administration_relation)
    {
        array_push($administrations,$administration_relation->administration);
    }
    return [
        'user' =>$request->user(),
        'administrations' => $administrations];
});
