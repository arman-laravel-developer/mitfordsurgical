<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\SellerProductController;

//seller login-registraion

Route::group(['prefix' => 'seller', 'middleware' =>  ['seller.login']], function() {
    Route::get('/register', [SellerController::class, 'register'])->name('seller.register');
    Route::get('/login', [SellerController::class, 'login'])->name('seller.login');
    Route::post('/store', [SellerController::class, 'store'])->name('seller.store');
    Route::post('/login-check', [SellerController::class, 'loginCheck'])->name('seller.login-check');
});


Route::get('/seller/verify', [SellerController::class, 'verify'])->name('seller.verify')->middleware('seller.logout');
Route::post('/verify-form-store', [SellerController::class, 'verify_form_store'])->name('verify.form.store');

Route::group(['prefix' => 'seller', 'middleware' =>  ['seller.logout','seller.verified', 'seller.unbanned']], function() {
    Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('seller.dashboard');

    Route::get('/product/add', [SellerProductController::class, 'index'])->name('seller.product-add');
    Route::get('/product/manage', [SellerProductController::class, 'manage'])->name('seller.product-manage');
    Route::post('/product/create', [SellerProductController::class, 'create'])->name('seller-product.new');
    Route::get('/product/edit/{id}', [SellerProductController::class, 'edit'])->name('seller-product.edit');
    Route::post('/product/update/{id}', [SellerProductController::class, 'update'])->name('seller-product.update');
    Route::post('/product/delete/{id}', [SellerProductController::class, 'delete'])->name('seller-product.delete');
});
Route::post('/seller/logout', [SellerDashboardController::class, 'logout'])->name('seller.logout')->middleware('seller.logout');

