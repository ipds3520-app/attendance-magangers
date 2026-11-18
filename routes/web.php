<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InternAuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('intern')->name('intern.')->group(function () {

    Route::middleware('guest:intern')->group(function () {
        Route::get('/login', [InternAuthController::class, 'showLogin'])
            ->name('login');

        Route::post('/login', [InternAuthController::class, 'login'])
            ->name('login.process');
    });

    Route::middleware('auth:intern')->group(function () {
        Route::get('/dashboard', [InternAuthController::class, 'dashboard'])
            ->name('dashboard');

        Route::post('/logout', [InternAuthController::class, 'logout'])
            ->name('logout');
    });

});