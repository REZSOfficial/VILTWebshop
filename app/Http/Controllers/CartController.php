<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Inertia\Inertia;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show()
    {
        $cart = Cart::where('user_id', auth()->user()->id)->with('cartItems.product')->first();

        return Inertia::render('Cart/Show', ['cart' => $cart]);
    }
}
