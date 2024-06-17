<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addToCart(Product $product, Request $request)
    {
        $quantity = $request['quantity'] ?? 1;
        $user = User::where('id', auth()->user()->id)->first();

        if (!$user->cart) {
            Cart::create(['user_id' => $user->id]);
            $user->load('cart');
        }

        if (CartItem::where('cart_id', $user->cart->id)->where('product_id', $product->id)->exists()) {
            $cartItem = $user->cart->cartItems->where('product_id', $product->id)->first();
            $cartItem->update([
                'cart_id' => $user->cart->id,
                'quantity' => $cartItem->quantity + $quantity
            ]);
        } else {
            CartItem::create([
                'cart_id' => $user->cart->id,
                'product_id' => $product->id,
                'quantity' => $quantity
            ]);
        }

        return back();
    }

    public function removeFromCart(Product $product)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $cartItem = $user->cart->cartItems->where('product_id', $product->id)->first();
        $cartItem->quantity = max(1, $cartItem->quantity - 1);
        $cartItem->save();

        return back();
    }
}
