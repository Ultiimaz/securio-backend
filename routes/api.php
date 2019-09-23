<?php

use Illuminate\Http\Request;
Route::post('authenticate','UserController@authenticateWithPassword');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
