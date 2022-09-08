<?php

namespace App\Http\Controllers;

use Modules\Vendor\Entities\Options;
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
