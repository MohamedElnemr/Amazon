<?php

namespace App\Http\Controllers;

use App\Models\Options;
use App\Http\Requests\StoreOptionsRequest;
use App\Http\Requests\UpdateOptionsRequest;

class OptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreOptionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOptionsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Options  $options
     * @return \Illuminate\Http\Response
     */
    public function show(Options $options)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Options  $options
     * @return \Illuminate\Http\Response
     */
    public function edit(Options $options)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOptionsRequest  $request
     * @param  \App\Models\Options  $options
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOptionsRequest $request, Options $options)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Options  $options
     * @return \Illuminate\Http\Response
     */
    public function destroy(Options $options)
    {
        //
    }
}
