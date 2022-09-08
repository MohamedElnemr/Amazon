<?php

namespace App\Http\Repositories;


use App\Http\Interfaces\CouponInterface;
use App\Http\Resources\CouponResource;
use App\Http\Traits\ApiDesignTrait;
//use App\Models\role;

use App\Models\Coupon;
use App\Models\User;

//use Illuminate\Database\Eloquent\Factories\Factory;
use F9Web\ApiResponseHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class CouponRepository implements CouponInterface {

//    use ApiDesignTrait;
    use ApiResponseHelpers;
    private $coupon;

    public function __construct(Coupon $coupon) {
        $this->coupon = $coupon;
    }

    public function index($request)
    {
//        dd('aa');
        try {
            $coupon = $this->coupon->all();
//            $coupon = Coupon::get();
            if(!is_null($coupon)){
                return $this->respondWithSuccess(CouponResource::collection($coupon));
            }
        }catch (\Exception $e){
            return $this->respondError($e->getMessage());
        }
    }


    public function show($coupon)
    {
        try {
//            $coupon = $this->coupon->find($request->coupon_id);
            return $this->respondWithSuccess(new CouponResource($coupon));
        }catch (\Exception $e){
            return $this->respondError($e->getMessage());
        }

    }


    public function store($request)
    {
        try {
            $coupon_code = rand(1000000000, 9999999999);

            $coupon = $this->coupon->create([
                'name' => $request->name,
                'coupon_code' => $coupon_code,
                'coupon_discount' => $request->coupon_discount,
                'from' => $request->from,
                'to' => $request->to,
            ]);
            return $this->respondWithSuccess(new CouponResource($coupon));
        }catch (\Exception $e){
            return $this->respondError($e->getMessage());
        }

    }


    public function update($request, $coupon)
    {
        try {
//            return($request);
//            $coupon = $this->coupon->find($request->coupon_id);
            $coupon_code = rand(1000000000, 9999999999);
            $coupon->update([
                'name' => $request->name,
                'coupon_code' => $coupon_code,
                'coupon_discount' => $request->coupon_discount,
                'from' => $request->from,
                'to' => $request->to,
            ]);
            return $this->respondWithSuccess(new CouponResource($coupon));
        }catch (\Exception $e){
            return $this->respondError($e->getMessage());
        }

    }

    public function destroy($coupon, $request)
    {
        try {
//            $coupon = $this->coupon->find($request->coupon_id);
//            if (is_null($coupon)) {
//                return $this->respondError('No Copuon Found');
//            }
            $coupon->delete();
            return $this->respondOk('deleted successfully');
        }catch (\Exception $e){
            return $this->respondError($e->getMessage());
        }


    }


    public function restoreCoupon($request)
    {
        try {
            $coupon = Coupon::withTrashed()->find($request->coupon_id);
            if (!is_null($coupon->deleted_at)) {
                $coupon->restore();
                return $this->respondWithSuccess(new CouponResource($coupon));
            }
            return $this->respondError('Coupon already restored');
        }catch (\Exception $e){
            return $this->respondError($e->getMessage());
        }

    }

}
