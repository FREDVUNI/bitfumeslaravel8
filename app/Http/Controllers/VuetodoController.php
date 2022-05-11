<?php

namespace App\Http\Controllers;

use App\Models\vuetodo;
use Illuminate\Http\Request;

class VuetodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return vuetodo::latest()->get();
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
        $data = $request->validate([
            "title" => "required|max:35|unique:vuetodos"
        ]);
        vuetodo::create($data);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\vuetodo  $vuetodo
     * @return \Illuminate\Http\Response
     */
    public function show(vuetodo $vuetodo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\vuetodo  $vuetodo
     * @return \Illuminate\Http\Response
     */
    public function edit(vuetodo $vuetodo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\vuetodo  $vuetodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, vuetodo $vuetodo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\vuetodo  $vuetodo
     * @return \Illuminate\Http\Response
     */
    public function destroy(vuetodo $vuetodo)
    {
        //
    }
}
