<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




// Test Controller Elnemr
Route::get('test1', [TestController::class, 'test_Event_Listener']);
Route::get('test2', [TestController::class, 'test_Pusher_with_event']);
Route::post('test3', [TestController::class, 'add_cart']);
