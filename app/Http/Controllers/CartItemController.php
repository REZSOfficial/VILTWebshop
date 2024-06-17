<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function delete(CartItem $cartItem)
    {
        $cartItem->delete();
        return back();
    }
}
