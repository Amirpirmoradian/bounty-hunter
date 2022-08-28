<?php
    
namespace App\Http\Controllers;
    
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        Product::create($request->all());
    
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        $product->update($request->all());
    
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }


    public function GetShop(Request $request, $seller)
    {
        $user = auth()->user();

        if(User::where('username', $seller)->exists()){
            $sellerId = User::where('username', $seller) ->first()->id;
            $productsInStock = DB::table('product_seller')->where('seller_id', $sellerId)->where('quantity', '!=', 0)->get()->pluck('product_id')->toArray();
            $products = Product::whereIn('id', $productsInStock)->get();
            return view('shop', compact('products', 'sellerId'));
        }

        return abort(404, 'Not found');
    }

    public function addToCart(Request $request, $productId, $sellerId)
    {
        $product = Product::find($productId);
        $cart = session('cart');
        if($cart == null){
            $cart = [
                'sellerId' => $sellerId,
                'products'  => [
                    $productId => [
                        "quantity" => 1,
                    ]
                ],
                'totalquantity' => 1,
                'total' => $product->price
            ];
            session()->put('cart', $cart);
        }else{
            if(isset($cart['products'][$productId])){
                $cart['products'][$productId]['quantity'] = $cart['products'][$productId]['quantity'] + 1;
            }else{
                $cart['products'][$productId]['quantity'] = 1;
            }
            $cart['totalquantity'] = $cart['totalquantity'] + 1;
            $cart['total'] = $cart['total'] + $product->price;
            session()->put('cart', $cart);
        }
       
        return redirect()->back();
        
        
    }

    public function removeFromCart(Request $request, $productId, $sellerId)
    {
        $cart = session('cart');
        $product = Product::find($productId);
        if($cart != null){
            if($cart['products'][$productId]['quantity']> 1){
                $cart['products'][$productId]['quantity'] = $cart['products'][$productId]['quantity'] - 1;
            }else{
                unset($cart['products'][$productId]);
            }
            $cart['totalquantity'] = $cart['totalquantity'] - 1;
            $cart['total'] = $cart['total'] - $product->price;
            session()->put('cart', $cart);
        }
        return redirect()->back();
        
    }
}