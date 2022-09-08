<?php

use Modules\User\http\controllers\AuthUserController;

Route::group(['prefix'=>'user','middleware'=>'guest:api'],function(){
    Route::post('login',[AuthUserController::class,'login']);
    Route::post('register',[AuthUserController::class,'register']);
    Route::post('logout',[AuthUserController::class,'logout']);

});


Route::resource('wallet', WalletController::class);

