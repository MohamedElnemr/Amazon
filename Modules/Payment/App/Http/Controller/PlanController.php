<?php

namespace Modules\Payment\Http\Controller;

use Modules\Payment\Models\Plan;
use App\Http\Controllers\Controller;
use Modules\Payment\Http\Requests\StorePlanRequest;
use Modules\Payment\Http\Requests\UpdatePlanRequest;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return $this->respondWithSuccess(Plan::get());
        } catch (\Throwable $e) {
            return $this->respondError($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePlanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlanRequest $request)
    {
        try {
            $plan = Plan::create($request->validated());
            return $plan;
        } catch (\Throwable $e) {
            return $this->respondError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlanRequest  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlanRequest $request , $id)
    {
        try {
            $plan = Plan::find($id)->update($request->validated());
            return Plan::find($id);
        } catch (\Throwable $e) {
            return $this->respondError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $plan = Plan::find($id);
            if ($plan) {
                Plan::destroy($id);
            }else{
                return response()->json(['message'=>'Not Found']);
            }
            return $this->respondWithSuccess(['message'=>'Deleted Successfully']);
        } catch (\Throwable $e) {
            return $this->respondError($e->getMessage());
        }
    }
}
