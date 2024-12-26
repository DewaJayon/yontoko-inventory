<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'register' => false,
    'verify' => false,
]);

Route::middleware(['auth', isAdmin::class])->group(function () {
    Route::resource('users', UserController::class);
    Route::get('/user/table', [UserController::class, 'table'])->name('users.table');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    Route::get('/category/table', [CategoryController::class, 'table'])->name('category.table');
    Route::resource('category', CategoryController::class)->except(['show', 'create']);

    Route::resource('product', ProductController::class);
    Route::get('/pos/search', [PosController::class, 'search'])->name('pos.search');
    Route::resource('pos', PosController::class);
    Route::resource('cart', CartController::class);
});


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
