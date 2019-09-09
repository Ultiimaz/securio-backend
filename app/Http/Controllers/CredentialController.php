<?php

namespace App\Http\Controllers;

use App\Credential;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CredentialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Credential
     */
    public function store(Request $request)
    {
        $credential = new Credential;
        $credential->fill($request->toArray());
        $credential->save();
        return $credential;
    }

    /**
     * Display the specified resource.
     *
     * @param Credential $credential
     * @return Credential
     */
    public function show(Credential $credential)
    {
        return $credential;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Credential $credential
     * @return void
     */
    public function edit(Credential $credential)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Credential $credential
     * @return Credential
     */
    public function update(Request $request,Credential $credential)
    {
        $credential->fill($request->toArray());
        $credential->save();
        return $credential;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Credential $credential
     * @return void
     * @throws \Exception
     */
    public function destroy(Credential $credential)
    {
        try {
            $credential->delete();
        } catch (Exception $e) {

        }
    }
}
