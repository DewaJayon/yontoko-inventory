<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'register' => false,
    'verify' => false,
]);

Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::resource('users', UserController::class);
Route::get('/user/table', [UserController::class, 'table'])->name('users.table');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
