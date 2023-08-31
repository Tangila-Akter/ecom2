<?php

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

Route::get('/', function () {
    return view('welcome');
});

// Shop
Route::group(['prefix' => 'shop'], function () {
    Route::get('/', [App\Http\Controllers\ShopController::class, 'index'])->name('shop.index');
    Route::post('create', [App\Http\Controllers\ShopController::class, 'store'])->name('shop.create');
    Route::get('show/{id}', [App\Http\Controllers\ShopController::class, 'show'])->name('shop.show');
    Route::get("edit/{id}", [App\Http\Controllers\ShopController::class, "edit"])->name('shop.edit');
    Route::post("update/{id}", [App\Http\Controllers\ShopController::class, "update"])->name('shop.update');
    Route::get("delete/{id}", [App\Http\Controllers\ShopController::class, "destroy"])->name('shop.delete');


    // add to cart
    Route::post('add-to-cart', [App\Http\Controllers\ShopController::class, 'addToCart'])->name('product.addToCart');
    // checkout
    Route::get('checkout', [App\Http\Controllers\ShopController::class, 'checkout'])->name('product.checkout');
    // remove item
    Route::post('remove-from-cart', [App\Http\Controllers\ShopController::class, 'removeCart'])->name('product.remove');
    // update item
    Route::post('update-cart', [App\Http\Controllers\ShopController::class, 'updateCart'])->name('product.updateCart');
    // create invoice
    Route::get('create-invoice', [App\Http\Controllers\ShopController::class, 'createInvoice'])->name('product.createInvoice');
});


// Product
Route::group(['prefix' => 'product'], function () {
    Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
    Route::post('create', [App\Http\Controllers\ProductController::class, 'store'])->name('product.create');
    Route::get('product/show/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');
    Route::get("edit/{id}", [App\Http\Controllers\ProductController::class, "edit"])->name('product.edit');
    Route::post("update/{id}", [App\Http\Controllers\ProductController::class, "update"])->name('product.update');
    Route::get("delete/{id}", [App\Http\Controllers\ProductController::class, "destroy"])->name('product.delete');
});


// invoice route group
Route::group(['prefix' => 'invoice'], function () {
    Route::get('/', [App\Http\Controllers\InvoiceController::class, 'index'])->name('invoice.index');
    // create invoice
    Route::get('create/{id}', [App\Http\Controllers\InvoiceController::class, 'createInvoice'])->name('invoice.create');
    Route::get('delete/{id}', [App\Http\Controllers\InvoiceController::class, 'destroy'])->name('invoice.delete');
});
