<?php

use App\Models\User;
use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\DashBoardController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::post('/products/{product}/addToCart', [ProductController::class, 'addToCart'])->name('addToCart');
    Route::post('/products/{product}/removeFromCart', [ProductController::class, 'removeFromCart'])->name('removeFromCart');
    Route::get('/cart', [CartController::class, 'show'])->name('showCart');
    Route::delete('/cart/{cartItem}', [CartItemController::class, 'delete'])->name('deleteCartItem');
});

Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard');
