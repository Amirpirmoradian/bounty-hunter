<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PanelController extends Controller
{
    



    public function index(Request $request)
    {
        return view('panel.index');
    }

    public function referrals(Request $request)
    {
        $seller = auth()->user();
        $referrals = User::where('referred_by', $seller->id)->get();
        return view('panel.referrals', compact('referrals'));

    }
    

    public function shelf(Request $request)
    {

        $seller = auth()->user();
        $products = $seller->products;
        $totalAmount = $seller->sellerOrders()->sum('order_total');
        $totalSold = DB::table('order_product')->whereIn('order_id', $seller->sellerOrders()->pluck('id')->toArray())->sum('quantity');
        $totalInStock = $seller->products()->sum('quantity');

        return view('panel.shelf', compact('products', 'totalAmount', 'totalSold', 'totalInStock'));

    }


    public function shelfInStock(Request $request)
    {

        $seller = auth()->user();
        $products = $seller->products()->where('quantity', '!=', 0)->get();

        return view('panel.shelfInStock', compact('products'));

    }

    public function shelfSold(Request $request)
    {
        $seller = auth()->user();
        $orders = $seller->sellerOrders;

        return view('panel.sold', compact('orders'));

    }


    public function orders(Request $request)
    {
        # code...
    }
    

    
}
