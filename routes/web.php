<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PriceTypeController;

Route::get('/', function () {
    return view('welcome');
});

// Category Table
Route::resource('categories', CategoryController::class);

// Product Table
Route::get('products/change-status', [ProductController::class, 'ChangeStatus'])->name('product.changeStatus');
Route::resource('products', ProductController::class);

// Product Price Type Table
Route::get('pricetypes', [PriceTypeController::class, 'index'])->name('products.price.Type');
Route::get('pricetypes/store', [PriceTypeController::class, 'storage'])->name('products.price.Type.store');
Route::get('pricetypes/edit/{id}', [PriceTypeController::class, 'edit'])->name('products.price.Type.edit');
Route::get('pricetypes/create', [PriceTypeController::class, 'create'])->name('products.price.Type.cewatw');
