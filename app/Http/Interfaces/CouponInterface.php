<?php
namespace App\Http\Interfaces;


interface CouponInterface {



    public function index($request);
    public function show($coupon);
    public function store($request);
    public function update($request, $coupon);
    public function destroy($coupon, $request);
    public function restoreCoupon($request);


}
