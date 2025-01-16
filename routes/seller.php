<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\SellerProductController;
use App\Http\Controllers\SellerOrderController;
use App\Http\Controllers\ManageShopController;

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

    Route::group(['prefix' => 'order', 'as' => 'seller.'], function(){
        Route::get('/all-order', [SellerOrderController::class, 'index'])->name('order.manage');
        Route::get('/pending-order', [SellerOrderController::class, 'pending'])->name('order.pending');
        Route::get('/confirmed-order', [SellerOrderController::class, 'confirmed'])->name('order.confirmed');
        Route::get('/proccessing-order', [SellerOrderController::class, 'proccessing'])->name('order.proccessing');
        Route::get('/delivered-order', [SellerOrderController::class, 'delivered'])->name('order.delivered');
        Route::get('/shipped-order', [SellerOrderController::class, 'shipped'])->name('order.shipped');
        Route::get('/canceled-order', [SellerOrderController::class, 'canceled'])->name('order.canceled');
        Route::get('/order-show/{id}', [SellerOrderController::class, 'show'])->name('order.show');
        Route::post('/order-delete/{id}', [SellerOrderController::class, 'delete'])->name('order.delete');
        Route::post('/order-payment-status-update', [SellerOrderController::class, 'paymentStatusUpdate'])->name('order-payment-status.update');
        Route::post('/order-status-update', [SellerOrderController::class, 'orderStatusUpdate'])->name('order-status.update');
    });

    Route::get('/manage/shop', [ManageShopController::class, 'index'])->name('seller.manage-shop');
    Route::post('/update/shop', [ManageShopController::class, 'update'])->name('seller.shop-update');
});
Route::post('/seller/logout', [SellerDashboardController::class, 'logout'])->name('seller.logout')->middleware('seller.logout');

