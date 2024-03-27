<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Route;



// ---------------admin panel route------------

Route::get('admin-login', [AdminController::class, 'login'])->name('admin.login');
Route::get('admin/register', [AdminController::class, 'register'])->name('admin.register');

Route::group(['middleware' => 'superAdmin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('product/category', [ProductCategoryController::class, 'index'])->name('category.index');
    // Route::get('product/category/create', [ProductCategoryController::class, 'create'])->name('category.create');
    Route::post('product/category/store', [ProductCategoryController::class, 'store'])->name('category.store');
    Route::get('product/category/edit/{id}', [ProductCategoryController::class, 'edit'])->name('category.edit');
    Route::post('product/category/update', [ProductCategoryController::class, 'update'])->name('category.update');
    Route::get('product/category/delete/{id}', [ProductCategoryController::class, 'delete'])->name('category.delete');

    Route::get('product/sub-category', [SubCategoryController::class, 'index'])->name('sub_category.index');
    Route::get('product/sub-category/create', [SubCategoryController::class, 'create'])->name('sub_category.create');
    Route::post('product/sub-category/store', [SubCategoryController::class, 'store'])->name('sub_category.store');


    Route::get('test', [ProductCategoryController::class, 'test'])->name('test');


    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
});
