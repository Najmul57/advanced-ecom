<?php

use App\Http\Controllers\FrontEnd\IndexController;
use App\Http\Controllers\FrontEnd\ReviewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('login',function(){
    return redirect()->to('/');
})->name('login');

Route::get('register',function(){
    return redirect()->to('/');
})->name('register');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/customer/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('customer.logout');

Route::group(['namespace' => 'App\Http\Controllers\FrontEnd'], function () {
    Route::get('/', [IndexController::class, 'index']);
    Route::get('product-detiails/{slug}', [IndexController::class, 'productDetails'])->name('product.details');



    Route::post('review/store', [ReviewController::class, 'store'])->name('store.review');
});
