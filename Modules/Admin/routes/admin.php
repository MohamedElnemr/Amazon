<?php

use Illuminate\Support\Facades\Route;
use Module\Admin\Http\Controllers\AdminController;
use Module\Admin\Http\Controllers\StoreAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
    return 'hello';
});





Route::Resource('category',CategoryController::class);

Route::Resource('store',StoreController::class);

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'


], function ($router) {

    Route::post('login', [AdminController::class, 'login']);
    Route::post('register', [AdminController::class, 'register']);
    Route::post('logout',  [AdminController::class, 'logout']);
    Route::post('refresh',  [AdminController::class, 'refresh']);
    Route::post('me',  [AdminController::class, 'me']);

});


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'


], function ($router) {

    Route::post('store-login', [StoreAuthController::class, 'login']);
    Route::post('store-register',[StoreAuthController::class, 'login']);
    Route::post('store-logout', [StoreAuthController::class, 'logout']);
    Route::post('store-refresh',[StoreAuthController::class, 'refresh']);
    Route::post('store-me', [StoreAuthController::class, 'me']);

});



