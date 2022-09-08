<?php

namespace App\Http\Controllers;


use App\Http\Interfaces\CouponInterface;
use App\Http\Requests\CouponFormRequest;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Http\Request;





class CouponController extends Controller
{


    private $couponInterface;

    public function __construct(CouponInterface $couponInterface)
    {
        $this->couponInterface = $couponInterface;
    }



    public function index(CouponFormRequest $request){

//        dd('aa');
        return $this->couponInterface->index($request);
    }

    public function show(Coupon $coupon){

        return $this->couponInterface->show($coupon);
    }

    public function store(CouponFormRequest $request){

        return $this->couponInterface->store($request);
    }


    public function update(CouponFormRequest $request, Coupon $coupon)
    {
        return $this->couponInterface->update($request, $coupon);
    }

    public function destroy(Coupon $coupon, CouponFormRequest $request)
    {
        return $this->couponInterface->destroy($coupon, $request);
    }

    public function restoreCoupon(CouponFormRequest $request)
    {
        return $this->couponInterface->restoreCoupon($request);
    }






}
