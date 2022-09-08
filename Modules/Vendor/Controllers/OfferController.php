<?php

namespace Modules\Vendor\Controllers;

use Illuminate\Http\Request;
use Modules\Vendor\Entities\Offer;
use App\Http\Controllers\Controller;
use Modules\Vendor\Resources\OfferResource;
use Modules\Vendor\Requests\StoreOfferRequest;
use Modules\Vendor\Requests\UpdateOfferRequest;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return $this->respondWithSuccess(OfferResource::collection(Offer::get()));
        } catch (\Throwable $e) {
            return $this->respondError($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOfferRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOfferRequest $request)
    {
        try {
            $offer = Offer::create($request->validated());
            return $this->respondWithSuccess(new OfferResource($offer));
        } catch (\Throwable $e) {
            return $this->respondError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,$offer)
    {

        try {
            $offer = Offer::find($offer);
            if($offer){
                return new OfferResource($offer);
            }else{
                return response()->json([
                    'Error Message' =>'Cant Find This Offer Or This Offer End',
                ], 404);
            }
        } catch (\Throwable $e) {
            return $this->respondError($e->getMessage());
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function deleted_offers(Offer $offer)
    {
        try {
            return $this->respondWithSuccess(Offer::onlyTrashed()->get());
        } catch (\Throwable $e) {
            return $this->respondError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOfferRequest  $request
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOfferRequest $request , $offer_id)
    {
        $offer = Offer::find($offer_id);
        try {
            if($offer){
                $offer->fill($request->validated())->save();
                return $this->respondWithSuccess(new OfferResource($offer));
            }else{
                return response()->json(['Error Message' =>'Cant Find This Offer Or This Offer End'], 404);
            }
        } catch (\Throwable $e) {
            return $this->respondError($e->getMessage());
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , $offer_id)
    {
       try {
        $offer = Offer::find($offer_id);
        if($offer){
            Offer::destroy($offer->id);
            return response()->json([ 'Message'=>'Deleted Successfuly'], 200);
        }else{
            return response()->json(['Message'=>'This Offer Cant Found'], 404);
        }
       } catch (\Throwable $e) {
        return $this->respondError($e->getMessage());
       }
    }


    public function restore_deleted_offers(Request $request , $offer_id)
    {
        try {
            $offer = Offer::find($offer_id)->onlyTrashed()->first();
            $offer->restore();
            return response()->json(['Message'=>'Restore Successfully'], 200);
        } catch (\Throwable $e) {
            return $this->respondError($e->getMessage());
        }
    }
}
