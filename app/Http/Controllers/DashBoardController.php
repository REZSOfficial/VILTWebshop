<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Product;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function index(Request $request)
    {
        $selectedBrandId = $request->query('selectedBrandId');
        $sort = $request->query('sort');

        $userData = null;

        if (auth()->user()) {
            $userData = User::where('id', auth()->user()->id)->first();

            $userData->load('cart.cartItems.product');
        }

        $products = null;
        if ($selectedBrandId || $sort) {
            if ($selectedBrandId && !$sort) {
                $products = Product::where('brand_id', $selectedBrandId)->with('brand')->paginate(16);
            } else if ($sort && !$selectedBrandId) {
                $products = Product::with('brand')->orderBy('price', $sort)->paginate(16);
            } else if ($selectedBrandId && $sort) {
                $products = Product::where('brand_id', $selectedBrandId)->orderBy('price', $sort)->with('brand')->paginate(16);
            }
        } else {
            $products = Product::with('brand')->paginate(16);
        }

        return Inertia::render('Dashboard/Show', [
            'brands' => Brand::all(),
            'products' => $products,
            'userData' => $userData
        ]);
    }
}
