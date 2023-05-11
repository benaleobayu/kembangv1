<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\FlowersController;
use App\Http\Controllers\LanggananController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\RegencyController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRolesController;





Route::middleware('auth')->group(function(){
    Route::resource('/customers', CustomersController::class);
    Route::resource('/subscribers', LanggananController::class );
    Route::resource('/riders', RiderController::class);
    
    Route::resource('/orders', OrdersController::class);

    Route::resource('/admin', UserController::class);
    Route::resource('/roles', RolesController::class);
    Route::resource('/regencies', RegencyController::class);
    Route::resource('/flowers', FlowersController::class);
    Route::get('/logout', [LoginController::class, 'logout']);

});

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('cms');
