<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OffCodeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', 'login');
Route::get('login/{seller?}', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('verify', [AuthController::class, 'showVerifyForm'])->name('verify');
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth']], function() {
    Route::get('offcode/{seller}', [OffCodeController::class, 'getOffcode'])->name('getOffcode');
    Route::get('shop/{seller}', [ProductController::class, 'GetShop']);
    Route::get('shop/add-to-cart/{productId}/{sellerId}', [ProductController::class, 'addToCart'])->name('addToCart');
    Route::get('shop/remove-from-cart/{productId}/{sellerId}', [ProductController::class, 'removeFromCart'])->name('removeFromCart');
    Route::get('cart', [CartController::class, 'getCart'])->name('cart');
    Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');
});


Route::group([
    'prefix' => '/admin',
    'middleware' => ['auth', 'admin'],
], function () {
    Route::get('/', [AdminController::class, 'index']);
    

    Route::resource('/products', ProductController::class, [
        'names' => [
            'index' => 'admin-products-list',
            'edit' => 'admin-products-edit',
            'destroy' => 'admin-products-delete',
            'update' => 'admin-products-update',
        ],
    ]);

    Route::resource('/orders', OrderController::class, [
        'names' => [
            'index' => 'admin-orders-list',
            'show' => 'admin-orders-show',
        ],
    ]);
    
    Route::get('clear/{order}', [OrderController::class, 'clear'])->name('admin-orders-clear');
    Route::get('unclear/{order}', [OrderController::class, 'unclear'])->name('admin-orders-unclear');


    Route::resource('/customers', CustomerController::class, [
        'names' => [
            'index' => 'admin-customers-list',
        ],
    ]);

    Route::resource('/sellers', SellerController::class, [
        'names' => [
            'index' => 'admin-sellers-list',
            'show' => 'admin-sellers-show',
        ],
    ]);

    Route::post('sellers/add-product/{seller}', [SellerController::class, 'addProduct'])->name('admin-sellers-add-product');
    Route::get('sellers/remove-product/{seller}/{product}', [SellerController::class, 'removeProduct'])->name('admin-sellers-remove-product');




    Route::redirect('/', route('admin-orders-list'));
});





Route::group([
    'prefix' => '/panel',
    'middleware' => ['auth', 'seller'],
], function () {
    Route::get('/', [PanelController::class, 'index'])->name('panel');
    Route::get('/referrals', [PanelController::class, 'referrals'])->name('referrals');
    Route::get('/shelf', [PanelController::class, 'shelf'])->name('shelf');
    Route::get('/shelf/instock', [PanelController::class, 'shelfInStock'])->name('shelfInStock');
    Route::get('/shelf/sold', [PanelController::class, 'shelfSold'])->name('shelfSold');
    Route::get('/order/{order}', [PanelController::class, 'orders'])->name('orders');
});
