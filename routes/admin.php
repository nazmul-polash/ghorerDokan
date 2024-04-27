<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PickupPointController;
use App\Http\Controllers\Backend\ProductCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\WareHouseController;
use Illuminate\Support\Facades\Route;



// ---------------admin panel route------------

Route::get('admin-login', [AdminController::class, 'login'])->name('admin.login');
Route::get('admin/register', [AdminController::class, 'register'])->name('admin.register');

Route::group(['prefix' => 'admin', 'middleware' => 'superAdmin'], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'product'], function () {

        Route::get('list', [ProductController::class, 'index'])->name('product.index');
        Route::get('create', [ProductController::class, 'create'])->name('product.create');
        Route::post('store', [ProductController::class, 'store'])->name('product.store');

        Route::get('sub/category/get',[ProductController::class, 'getSubCategory'])->name('get.subcategory');
        Route::get('child/category/get',[ProductController::class, 'getChildCategory'])->name('get.child.category');

        Route::group(['prefix' => 'category'], function () {
            Route::get('list', [ProductCategoryController::class, 'index'])->name('category.index');
            // Route::get('create', [ProductCategoryController::class, 'create'])->name('category.create');
            Route::post('store', [ProductCategoryController::class, 'store'])->name('category.store');
            Route::get('edit/{id}', [ProductCategoryController::class, 'edit'])->name('category.edit');
            Route::post('update', [ProductCategoryController::class, 'update'])->name('category.update');
            Route::get('delete/{id}', [ProductCategoryController::class, 'delete'])->name('category.delete');
        });
        Route::group(['prefix' => 'sub-category'], function () {
            Route::get('list', [SubCategoryController::class, 'index'])->name('sub_category.index');
            Route::get('create', [SubCategoryController::class, 'create'])->name('sub_category.create');
            Route::post('store', [SubCategoryController::class, 'store'])->name('sub_category.store');
            Route::get('edit/{id}', [SubCategoryController::class, 'edit'])->name('sub_category.edit');
            Route::post('update', [SubCategoryController::class, 'update'])->name('sub_category.update');
            Route::get('delete/{id}', [SubCategoryController::class, 'delete'])->name('sub_category.delete');
        });
        Route::group(['prefix' => 'child-category'], function () {
            Route::get('list', [ChildCategoryController::class, 'index'])->name('child_category.index');
            Route::get('create', [ChildCategoryController::class, 'create'])->name('child_category.create');
            Route::post('store', [ChildCategoryController::class, 'store'])->name('child_category.store');
            Route::get('edit/{id}', [ChildCategoryController::class, 'edit'])->name('child_category.edit');
            Route::post('update', [ChildCategoryController::class, 'update'])->name('child_category.update');
            Route::get('delete{id}', [ChildCategoryController::class, 'delete'])->name('child_category.delete');
        });
        Route::group(['prefix' => 'brand'], function () {
            Route::get('list', [BrandController::class, 'index'])->name('brand.index');
            Route::post('store', [BrandController::class, 'store'])->name('brand.store');
            Route::get('edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
            Route::post('update', [BrandController::class, 'update'])->name('brand.update');
            Route::get('delete{id}', [BrandController::class, 'delete'])->name('brand.delete');
        });
    });

    Route::group(['prefix' => 'warehouse'], function () {
        Route::get('list', [WareHouseController::class, 'index'])->name('warehouse.index');
        Route::post('store', [WareHouseController::class, 'store'])->name('warehouse.store');
        Route::get('edit/{id}', [WareHouseController::class, 'edit'])->name('warehouse.edit');
        Route::post('update', [WareHouseController::class, 'update'])->name('warehouse.update');
        Route::get('delete{id}', [WareHouseController::class, 'delete'])->name('warehouse.delete');
    });
    Route::group(['prefix' => 'pickup-point'], function () {
        Route::get('list', [PickupPointController::class, 'index'])->name('pickup_point.index');
        Route::post('store', [PickupPointController::class, 'store'])->name('pickup_point.store');
        Route::get('edit/{id}', [PickupPointController::class, 'edit'])->name('pickup_point.edit');
        Route::post('update', [PickupPointController::class, 'update'])->name('pickup_point.update');
        Route::get('delete{id}', [PickupPointController::class, 'delete'])->name('pickup_point.delete');
    });

    Route::group(['prefix' => 'offer'], function () {
        Route::group(['prefix' => 'coupon'], function () {
            Route::get('list', [CouponController::class, 'index'])->name('coupon.index');
            Route::post('store', [CouponController::class, 'store'])->name('coupon.store');
            Route::get('edit/{id}', [CouponController::class, 'edit'])->name('coupon.edit');
            Route::post('update', [CouponController::class, 'update'])->name('coupon.update');
            Route::get('delete{id}', [CouponController::class, 'delete'])->name('coupon.delete');
        });
    });
});
