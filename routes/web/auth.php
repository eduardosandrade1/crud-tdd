<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('login')->name('login.')->group(function () {

    Route::get('/', [AuthController::class, 'create'])->name('create');
    Route::post('/', [AuthController::class, 'store'])->name('store');

});

Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');
