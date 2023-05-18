<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\DayOnOrderController;
use App\Http\Controllers\FlowersController;
use App\Http\Controllers\LanggananController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\RegencyController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('index');
    });
    Route::get('/home', [HomeController::class, 'index'])->name('cms');

    Route::resource('/customers', CustomersController::class)->middleware('can:Read_Customers');
    Route::resource('/subscribers', LanggananController::class)->middleware('can:Read_Langganan');
    Route::get('/get-customer-data/{name}', [LanggananController::class, 'getCustomerData'])->name('getCustomerData');
    Route::resource('/daysubscribs', DayController::class)->parameters(['daysubscribs' => 'slug'])->middleware('can:Read_Langganan');
    Route::resource('/riders', RiderController::class)->middleware('can:Read_DataRiders');

    Route::resource('/orders', OrdersController::class)->parameters(['orders' => 'slug'])->middleware('can:Read_DataOrders');
    Route::resource('/day', DayOnOrderController::class)->parameters(['day' => 'slug'])->middleware('can:Read_DataOrders');
    Route::get('/orders/import', [OrdersController::class, 'showImportForm']);
    Route::post('/orders/import', [OrdersController::class, 'importData']);



    Route::resource('/regencies', RegencyController::class)->middleware('can:Read_Regency');
    Route::resource('/flowers', FlowersController::class)->middleware('can:Read_Flower');

    Route::get('/logout', [LoginController::class, 'logout']);
});

Route::middleware('auth:web')->group(function () {
    Route::resource('/admin', UserController::class)->middleware('can:Read_Admin');
    Route::resource('/roles', RolesController::class)->middleware('can:Read_Roles');
});


Auth::routes(['register' => false]);
