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
    Route::get('pos', [PosController::class, 'index'])->name('pos.index');
    Route::resource('cart', CartController::class)->except(['create', 'show', 'edit', 'update']);
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/cart/store-qty', [CartController::class, 'storeQty'])->name('cart.store-qty');
    Route::post('/cart/destroy-qty', [CartController::class, 'destroyQty'])->name('cart.destroy-qty');
});


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
