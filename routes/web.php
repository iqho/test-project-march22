<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('categories', CategoryController::class);


Route::get('products/change-status', [ProductController::class, 'ChangeStatus'])->name('product.changeStatus');
Route::resource('products', ProductController::class);



