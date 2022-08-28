<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{


    public function getCart(Request $request)
    {
        $cart = session('cart');
        foreach ($cart['products'] as $productId => $productKey) {
            $cart['products'][$productId]['data'] = Product::find($productId)->toArray();
        }
        $seller = User::find($cart['sellerId']);
        return view('cart', compact('cart', 'seller'));
    }

    public function checkout(Request $request)
    {
        $cart = session('cart');
        if ($cart != null) {
            $customer = auth()->user();
            $seller = User::find($cart['sellerId']);
            $order = Order::create([
                'customer_id'   => $customer->id,
                'seller_id' => $cart['sellerId'],
                'order_total' => $cart['total'],
            ]);

            foreach ($cart['products'] as $productId => $product) {
                DB::table('order_product')->insert([
                    'order_id'  => $order->id,
                    'product_id' => $productId,
                    'price' => Product::find($productId)->price,
                    'quantity' => $product['quantity']
                ]);
            }
            //TODO we need to check for remaining quantity in seller saloon
            session()->flash('cart');

            return view('checkout', compact('order', 'seller'));
        }
    }
}
