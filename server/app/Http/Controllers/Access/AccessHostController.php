<?php

namespace App\Http\Controllers\Access;

use App\Http\Controllers\Controller;
use App\Models\AccessHost;
use Illuminate\Http\Request;

class AccessHostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accesses = AccessHost::all();

        return;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccessHost  $accessHost
     * @return \Illuminate\Http\Response
     */
    public function show(AccessHost $accessHost)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccessHost  $accessHost
     * @return \Illuminate\Http\Response
     */
    public function edit(AccessHost $accessHost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccessHost  $accessHost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccessHost $accessHost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccessHost  $accessHost
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccessHost $accessHost)
    {
        //
    }
}
