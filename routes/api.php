<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChoultryController;


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
