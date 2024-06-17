<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function index()
    {
        $userData = null;

        if (auth()->user()) {
            $userData = User::where('id', auth()->user()->id)->first();

            $userData->load('cart.cartItems.product');
        }

        $products = Product::with('brand')->paginate(16);

        return Inertia::render('Dashboard', [
            'products' => $products,
            'userData' => $userData
        ]);
    }
}
