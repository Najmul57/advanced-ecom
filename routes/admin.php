<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildcategoryController;
use App\Http\Controllers\Admin\SubategoryController;
use Illuminate\Support\Facades\Route;


Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'is_admin'], function () {
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin.home');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    //category
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
        Route::get('/edit/{id}', [CategoryController::class, 'edit']);
        Route::post('/update', [CategoryController::class, 'update'])->name('category.update');
    });

    //subcategory
    Route::group(['prefix' => 'subcategory'], function () {
        Route::get('/', [SubategoryController::class, 'index'])->name('subcategory.index');
        Route::post('/store', [SubategoryController::class, 'store'])->name('subcategory.store');
        Route::get('/delete/{id}', [SubategoryController::class, 'destroy'])->name('subcategory.delete');
        Route::get('/edit/{id}', [SubategoryController::class, 'edit']);
        Route::post('/update', [SubategoryController::class, 'update'])->name('subcategory.update');
    });
    //childcategory
    Route::group(['prefix' => 'childcategory'], function () {
        Route::get('/', [ChildcategoryController::class, 'index'])->name('childcategory.index');
        Route::post('/store', [ChildcategoryController::class, 'store'])->name('childcategory.store');
        Route::get('/delete/{id}', [ChildcategoryController::class, 'destroy'])->name('childcategory.delete');
        Route::get('/edit/{id}', [ChildcategoryController::class, 'edit']);
        Route::post('/update', [ChildcategoryController::class, 'update'])->name('childcategory.update');
    });
    //brand
    Route::group(['prefix' => 'brand'], function () {
        Route::get('/', [BrandController::class, 'index'])->name('brand.index');
        Route::post('/store', [BrandController::class, 'store'])->name('brand.store');
        Route::get('/delete/{id}', [BrandController::class, 'destroy'])->name('brand.delete');
        Route::get('/edit/{id}', [BrandController::class, 'edit']);
        Route::post('/update', [BrandController::class, 'update'])->name('brand.update');
    });
});
