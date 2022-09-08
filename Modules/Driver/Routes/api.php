<?php

use Illuminate\Support\Facades\Route;
use Modules\Driver\Http\Controllers\HomeController;

Route::get('driver-home',[HomeController::class,'index']);