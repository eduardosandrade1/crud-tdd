<?php

use App\Http\Controllers\Auth\HomeController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->get('/home', [HomeController::class, 'index'])->name('home');
