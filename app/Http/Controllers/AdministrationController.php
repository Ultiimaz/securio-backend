<?php

namespace App\Http\Controllers;

use App\Administration;
use App\AdministrationRelation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministrationController extends Controller
{
    public function attachToAdministration(Administration $administration)
    {
        $relation = new AdministrationRelation;
        $relation->administration_id = $administration->id;
        $relation->user_id = Auth::user()->id;
        $relation->save();
    }
    public function attachToAdministrationById($administration_id)
    {
        //adds new user to administration
        $relation = new AdministrationRelation;
        $relation->administration_id = $administration_id;
        $relation->user_id = Auth::user()->id;
        $relation->save();
    }
    public function detachFromAdministration(Administration $administration){
        // removes user from an administration
        $relation = AdministrationRelation::Where(function($query) use ($administration){
            $query->where('administration_id',$administration->id);
        });
    }
    public function showMembers(Administration $administration){
        // shows all users in current administration
    return AdministrationRelation::where('administration_id',$administration->id)->get();

    }
}
