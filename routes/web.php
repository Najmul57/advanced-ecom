<?php

use App\Http\Controllers\FrontEnd\CartController;
use App\Http\Controllers\FrontEnd\IndexController;
use App\Http\Controllers\FrontEnd\ReviewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('login',function(){
    return redirect()->to('/');
})->name('login');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/customer/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('customer.logout');

Route::group(['namespace' => 'App\Http\Controllers\FrontEnd'], function () {
    Route::get('/', [IndexController::class, 'index']);
    Route::get('product-detiails/{slug}', [IndexController::class, 'productDetails'])->name('product.details');
    Route::get('product_quick_view/{id}', [IndexController::class, 'product_quick_view']);

    Route::get('all-cart',[CartController::class,'allCart'])->name('all.cart');
    Route::get('/my-cart',[CartController::class,'mycart'])->name('cart');
    Route::post('add-to-cart',[CartController::class,'add_to_cart_quickview'])->name('add.to.cart.quickview');
    Route::get('/cartproduct/remove/{rowId}',[CartController::class,'removeproduct']);
    Route::get('/cartproduct/updateqty/{rowId}/{qty}',[CartController::class,'updateqty']);
    Route::get('/cartproduct/updatecolor/{rowId}/{color}',[CartController::class,'updatecolor']);
    Route::get('/cartproduct/updatesize/{rowId}/{size}',[CartController::class,'updatesize']);
    Route::get('/cart/empty',[CartController::class,'cartempty'])->name('cart.empty');
    // wishlist
    Route::get('add/wishlist/{id}', [CartController::class, 'wishlist'])->name('add.wishlist');

    Route::post('review/store', [ReviewController::class, 'store'])->name('store.review');
});
