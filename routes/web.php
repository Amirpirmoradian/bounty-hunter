<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OffCodeController;
use App\Http\Controllers\ProductController;
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
    Route::get('offcode/{seller}', [OffCodeController::class, 'getOffcode']);
    Route::get('shop/{seller}', [ProductController::class, 'GetShop']);
    Route::get('shop/add-to-cart/{productId}/{sellerId}', [ProductController::class, 'addToCart'])->name('addToCart');
    Route::get('shop/remove-from-cart/{productId}/{sellerId}', [ProductController::class, 'removeFromCart'])->name('removeFromCart');
    Route::get('cart', [CartController::class, 'getCart'])->name('cart');
    Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');
});
