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
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRolesController;

Route::resource('/customers', CustomersController::class)->middleware('auth');
Route::resource('/subscribers', LanggananController::class )->middleware('auth');
Route::resource('/riders', RiderController::class)->middleware('auth');

Route::resource('/orders', OrdersController::class)->middleware('auth');

Route::resource('/admin', UserController::class);
Route::resource('/roles', UserRolesController::class);
Route::resource('/regencies', RegencyController::class);
Route::resource('/flowers', FlowersController::class)->middleware('auth');


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('cms');
Route::get('/logout', [LoginController::class, 'logout']);
