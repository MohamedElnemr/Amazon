<?php

use Illuminate\Support\Facades\Route;
use Modules\Vendor\Controllers\AuthStoreController;

//Login Store
Route::post('login-store', [AuthStoreController::class, "login"]);

//LogOut Store
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::post('logout-store', [AuthStoreController::class, "logout"]);
});

//Products
Route::apiResource('product', ProductController::class);

//Offer
Route::apiResource('offer', OfferController::class);

