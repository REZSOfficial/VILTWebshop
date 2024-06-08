<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;


class ProductController extends Controller
{
    public function addToCart(Product $product)
    {
        $user = User::where('id', auth()->user()->id)->first();

        if (!$user->cart) {
            Cart::create(['user_id' => $user->id]);
            $user->load('cart');
        }

        if (CartItem::where('cart_id', $user->cart->id)->where('product_id', $product->id)->exists()) {
            $cartItem = $user->cart->cartItems->where('product_id', $product->id)->first();
            $cartItem->update([
                'cart_id' => $user->cart->id,
                'quantity' => $cartItem->quantity + 1
            ]);
        } else {
            CartItem::create([
                'cart_id' => $user->cart->id,
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }

        return back();
    }
}
