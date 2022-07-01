<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildcategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PickupController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubategoryController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;


Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'is_admin'], function () {
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin.home');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/password/change', [AdminController::class, 'passwordchange'])->name('admin.password.change');
    Route::post('/admin/password/update', [AdminController::class, 'passwordUpdate'])->name('admin.password.update');

    //category
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
        Route::get('/edit/{id}', [CategoryController::class, 'edit']);
        Route::post('/update', [CategoryController::class, 'update'])->name('category.update');
    });

    // global route
    Route::get('/get-child-category/{id}',[CategoryController::class,'getChildCategory']);

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
    //coupon
    Route::group(['prefix' => 'coupon'], function () {
        Route::get('/', [CouponController::class, 'index'])->name('coupon.index');
        Route::post('/store', [CouponController::class, 'store'])->name('coupon.store');
        Route::get('/delete/{id}', [CouponController::class, 'destroy'])->name('coupon.delete');
        Route::get('/edit/{id}', [CouponController::class, 'edit']);
        Route::post('/update/{id}', [CouponController::class, 'update'])->name('coupon.update');
    });
    //coupon
    Route::group(['prefix' => 'campaign'], function () {
        Route::get('/', [CampaignController::class, 'index'])->name('campaign.index');
        Route::post('/store', [CampaignController::class, 'store'])->name('campaign.store');
        Route::get('/delete/{id}', [CampaignController::class, 'destroy'])->name('campaign.delete');
        Route::get('/edit/{id}', [CampaignController::class, 'edit']);
        Route::post('/update/{id}', [CampaignController::class, 'update'])->name('campaign.update');
    });
    //product
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        // Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update');

        Route::get('not-featured/{id}',[ProductController::class,'notFeatured']);
        Route::get('active-featured/{id}',[ProductController::class,'activeFeatured']);

        Route::get('not-deal/{id}',[ProductController::class,'notDeal']);
        Route::get('active-deal/{id}',[ProductController::class,'activeDeal']);

        Route::get('not-status/{id}',[ProductController::class,'notstatus']);
        Route::get('active-status/{id}',[ProductController::class,'activestatus']);

    });
    //warehouse
    Route::group(['prefix' => 'warehouse'], function () {
        Route::get('/', [WarehouseController::class, 'index'])->name('warehouse.index');
        Route::post('/store', [WarehouseController::class, 'store'])->name('warehouse.store');
        Route::get('/delete/{id}', [WarehouseController::class, 'destroy'])->name('warehouse.delete');
        Route::get('/edit/{id}', [WarehouseController::class, 'edit']);
        Route::post('/update/{id}', [WarehouseController::class, 'update'])->name('warehouse.update');
    });
    //setting
    Route::group(['prefix' => 'setting'], function () {
        // seo setting
        Route::group(['prefix' => 'seo'], function () {
            Route::get('/', [SettingController::class, 'seo'])->name('seo.setting');
            Route::post('update/{id}', [SettingController::class, 'seoUpdate'])->name('seo.setting.update');
        });
        // smtp setting
        Route::group(['prefix' => 'smtp'], function () {
            Route::get('/', [SettingController::class, 'smtp'])->name('smtp.setting');
            Route::post('update/{id}', [SettingController::class, 'smtpUpdate'])->name('smtp.setting.update');
        });
        // website setting
        Route::group(['prefix' => 'website'], function () {
            Route::get('/', [SettingController::class, 'website'])->name('website.setting');
            Route::post('update/{id}', [SettingController::class, 'websiteUpdate'])->name('website.setting.update');
        });
        // page setting
        Route::group(['prefix' => 'page'], function () {
            Route::get('/', [PageController::class, 'page'])->name('page.index');
            Route::get('/create', [PageController::class, 'create'])->name('page.create');
            Route::post('/store', [PageController::class, 'store'])->name('page.store');
            Route::get('/delete/{id}', [PageController::class, 'destroy'])->name('page.delete');
            Route::get('/edit/{id}', [PageController::class, 'edit'])->name('page.edit');
            Route::post('/update/{id}', [PageController::class, 'update'])->name('page.update');
        });
        // pickup-point
        Route::group(['prefix' => 'pickup-point'], function () {
            Route::get('/', [PickupController::class, 'index'])->name('pickup-point.index');
            Route::get('/create', [PickupController::class, 'create'])->name('pickup-point.create');
            Route::post('/store', [PickupController::class, 'store'])->name('pickup-point.store');
            Route::get('/delete/{id}', [PickupController::class, 'destroy'])->name('pickup-point.delete');
            Route::get('/edit/{id}', [PickupController::class, 'edit'])->name('pickup-point.edit');
            Route::post('/update/{id}', [PickupController::class, 'update'])->name('pickup-point.update');
        });
    });
});
