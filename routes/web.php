<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\FlowersController;
use App\Http\Controllers\LanggananController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\RegencyController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;


Route::middleware('auth:web')->group(function () {
    Route::get('/', function(){
        Return view('index');
    });
    Route::get('/home', [HomeController::class, 'index'])->name('cms');

    Route::resource('/customers', CustomersController::class)->middleware('can:Read_Customers');
    Route::resource('/subscribers', LanggananController::class)->middleware('can:Read_Langganan');
    Route::get('/subscriberss', 'LanggananController@search')->name('subscriberss');
    Route::resource('/daysubscribs', DayController::class)->parameters(['daysubscribs' => 'slug'])->middleware('can:Read_Langganan');
    Route::resource('/riders', RiderController::class)->middleware('can:Read_DataRiders');

    Route::resource('/orders', OrdersController::class)->middleware('can:Read_DataOrders');

    Route::resource('/admin', UserController::class)->middleware('can:Read_Admin');
    Route::resource('/roles', RolesController::class)->middleware('can:Read_Roles');
    Route::resource('/regencies', RegencyController::class)->middleware('can:Read_Regency');
    Route::resource('/flowers', FlowersController::class)->middleware('can:Read_Flower');

    Route::get('/logout', [LoginController::class, 'logout']);
});


Auth::routes(['register' => false]);
