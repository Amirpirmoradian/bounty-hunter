<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    

    public function getCart(Request $request)
    {
        $cart = session('cart');
        foreach($cart['products'] as $productId => $productKey){
            $cart['products'][$productId]['data'] = Product::find($productId)->toArray();
        }
        $seller = User::find($cart['sellerId']);
        return view('cart', compact('cart', 'seller'));
    }

    public function checkout(Request $request)
    {
        $cart = session('cart');
        
    }

}
