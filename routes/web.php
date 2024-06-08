<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
});

Route::get('/dashboard', function () {
    $userData = null;

    if (auth()->user()) {
        $userData = User::where('id', auth()->user()->id)->first();

        $userData->load('cart.cartItems.product');
    }

    return Inertia::render('Dashboard', [
        'products' => Product::all(),
        'userData' => $userData
    ]);
})->name('dashboard');
