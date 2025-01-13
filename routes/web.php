<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CategoryProductsController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SellerDashboardController;
use App\Models\RoleRoute;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TrackOrderController;

function getRoleName($routeName)
{
    $routesData = RoleRoute::where('route_name', $routeName)->get();
    $result = [];
    foreach ($routesData as $routeData) {
        array_push($result, $routeData->role_name);
    }
    return $result;
}
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


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy.page');
Route::get('/return', [HomeController::class, 'returnPage'])->name('return.page');
Route::get('/conditions', [HomeController::class, 'condition'])->name('condition.page');
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about.us');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact.us');

Route::get('/product-detail/{id}-{slug}', [HomeController::class, 'detail'])->name('product.detail');
Route::get('/get-variant', [HomeController::class, 'getVariant'])->name('get.variant');

Route::get('/search-result', [HomeController::class, 'result'])->name('search.result');
Route::get('/search', [HomeController::class, 'search'])->name('product.search');
Route::get('/products', [HomeController::class, 'products'])->name('products.all');

Route::get('/category-products/{id}-{slug}', [CategoryProductsController::class,'index'])->name('category.product');

Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart-dropdown', [CartController::class, 'dropdown'])->name('cart.dropdown');
Route::delete('/cart-remove', [CartController::class, 'cartRemove'])->name('cart.remove');
Route::post('/update-cart', [CartController::class, 'updateQuantity'])->name('cart.update');

Route::get('/invoice-download/{id}', [CheckoutController::class, 'index'])->name('invoice.download');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::get('/fetch-customer-data', [CustomerController::class, 'fetchCustomerData'])->name('get.customer-data');

Route::post('/order-store', [OrderController::class, 'store'])->name('order.store');
Route::get('/order-confirmation', [OrderController::class, 'confirmation'])->name('order.confirmation');

Route::get('/track-my-order', [TrackOrderController::class, 'index'])->name('track.order');
Route::get('/track-my-order-result', [TrackOrderController::class, 'result'])->name('show.track-result');

Route::middleware('customer.login')->group(function () {
    Route::get('/customer-register', [CustomerController::class, 'register'])->name('customer.register');
    Route::get('/customer-login', [CustomerController::class, 'login'])->name('customer.login');
    Route::post('/customer-store', [CustomerController::class, 'store'])->name('customer.store');
    Route::post('/customer-login-check', [CustomerController::class, 'loginCheck'])->name('customer.login-check');

    Route::get('/forget-password', [CustomerController::class, 'forget'])->name('forget.password');
    Route::post('/forget-password-send-otp', [CustomerController::class, 'sendCode'])->name('forget.password-send-code');
    Route::get('/forget-password-verify', [CustomerController::class, 'verify'])->name('forget.verify');
    Route::post('/resend-otp', [CustomerController::class, 'resendOtp'])->name('resend.otp');
    Route::post('/otp-check', [CustomerController::class, 'otpCheck'])->name('otp.check');
    Route::get('/set-password', [CustomerController::class, 'setPassword'])->name('set.password');
    Route::post('/save-password', [CustomerController::class, 'savePassword'])->name('save.password');

});
Route::post('/contact-form', [ContactFormController::class, 'submit'])->name('contact-form.submit');
Route::post('/language', [LanguageController::class, 'changeLanguage'])->name('language.change');
Route::middleware('customer.logout')->group(function () {
    Route::get('/customer-dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    Route::post('/customer-logout', [CustomerDashboardController::class, 'logout'])->name('customer.logout');

    Route::post('/profile-update', [CustomerDashboardController::class, 'profileUpdate'])->name('profile.update');
    Route::post('/profile-image-update', [CustomerDashboardController::class, 'profileImageUpdate'])->name('profile.image-update');
    Route::post('/store-active-tab', [CustomerDashboardController::class, 'storeActiveTab'])->name('store.active.tab');

    Route::post('/password-update', [CustomerDashboardController::class, 'passwordUpdate'])->name('password.update');

});


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
});
Route::post('/seller/logout', [SellerDashboardController::class, 'logout'])->name('seller.logout')->middleware('seller.logout');


Route::get('/error', function () {
    return view('errors.404');
});


