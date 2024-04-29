<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChoultryController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/auth/choutries', [ChoultryController::class, 'index']);
});
