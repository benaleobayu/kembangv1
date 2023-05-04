<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\FlowersController;
use App\Http\Controllers\LanggananController;
use App\Http\Controllers\RegencyController;
use App\Http\Controllers\RiderController;

Route::get('/', function () {
    return view('index');
});
Route::resource('/customers', CustomersController::class);
Route::resource('/subscribers', LanggananController::class );
Route::resource('/riders', RiderController::class);

Route::resource('/regencies', RegencyController::class);
Route::resource('/flowers', FlowersController::class);


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
