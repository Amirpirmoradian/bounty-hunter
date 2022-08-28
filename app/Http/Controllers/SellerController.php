<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = User::where('type', 'seller')->paginate(15);
        return view('admin.sellers.index', compact('sellers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seller = User::find($id);
        $products = Product::all();
        return view('admin.sellers.show', compact('seller', 'products'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addProduct(Request $request, $id)
    {
        $seller = User::find($id);

        if(DB::table('product_seller')->where('seller_id', $seller->id)->where('product_id', $request->product_id)->exists()){
            $inventory = DB::table('product_seller')->where('seller_id', $seller->id)->where('product_id', $request->product_id)->first();
            DB::table('product_seller')->where('seller_id', $seller->id)->where('product_id', $request->product_id)->update([
                'quantity' => $inventory->quantity + $request->quantity
            ]);
        }else{
            DB::table('product_seller')->insert([
                'product_id' => $request->product_id,
                'seller_id' => $seller->id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->back()->with('success', trans('محصول با موفقیت اضافه شد.'));
    }


    public function removeProduct(Request $request, $sellerId, $productId)
    {
        
        DB::table('product_seller')->where('seller_id', $sellerId)->where('product_id', $productId)->delete();

        return redirect()->back()->with('success', trans('محصول با موفقیت حذف شد.'));
    }
}
