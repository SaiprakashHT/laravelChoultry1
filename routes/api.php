<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChoultryController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingItemController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OutwardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserRoleController;

    Route::get('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'register']);
    Route::get('users', [AuthController::class, 'user']);

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    

    Route::group(['middleware' => 'auth:sanctum'], function() {
      Route::get('logout', [AuthController::class, 'logout']);
      Route::get('user', [AuthController::class, 'user']);
      Route::resource('choutries', ChoultryController::class);
      Route::resource('bills', BillController::class);
      Route::resource('bokings', BookingController::class);
      Route::resource('booking_items', BookingItemController::class);
      Route::resource('customers', CustomerController::class);
      Route::resource('inventories', InventoryController::class);
      Route::resource('outwards', OutwardController::class);
      Route::resource('roles', RoleController::class);
      Route::resource('user_roles', UserRoleController::class);
    });
});
