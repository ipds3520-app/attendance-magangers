<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InternAuthController;

Route::get('/', function () {
    return redirect()->route('intern.login');
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

        Route::get('/attendance/history', [InternAuthController::class, 'attendanceHistory'])
            ->name('attendance.history');

        Route::post('/attendance/check-in', [InternAuthController::class, 'checkIn'])
            ->name('attendance.checkin');

        Route::post('/attendance/check-out', [InternAuthController::class, 'checkOut'])
            ->name('attendance.checkout');

        Route::post('/logout', [InternAuthController::class, 'logout'])
            ->name('logout');
    });

    

});