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
use App\Models\RoleRoute;

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

Route::post('/language', [LanguageController::class, 'changeLanguage'])->name('language.change');

Route::get('/category-products/{id}-{slug}', [CategoryProductsController::class,'index'])->name('category.product');

Route::get('/customer-register', [CustomerController::class, 'register'])->name('customer.register');
Route::get('/customer-login', [CustomerController::class, 'login'])->name('customer.login');
Route::post('/customer-store', [CustomerController::class, 'store'])->name('customer.store');
Route::post('/customer-login-check', [CustomerController::class, 'loginCheck'])->name('customer.login-check');

Route::get('/forget-password', [CustomerController::class, 'forget'])->name('forget.password')->middleware('customer.login');
Route::post('/forget-password-send-otp', [CustomerController::class, 'sendCode'])->name('forget.password-send-code')->middleware('customer.login');
Route::get('/forget-password-verify', [CustomerController::class, 'verify'])->name('forget.verify')->middleware('customer.login');
Route::post('/resend-otp', [CustomerController::class, 'resendOtp'])->name('resend.otp')->middleware('customer.login');
Route::post('/otp-check', [CustomerController::class, 'otpCheck'])->name('otp.check')->middleware('customer.login');
Route::get('/set-password', [CustomerController::class, 'setPassword'])->name('set.password')->middleware('customer.login');
Route::post('/save-password', [CustomerController::class, 'savePassword'])->name('save.password')->middleware('customer.login');

Route::post('/contact-form', [ContactFormController::class, 'submit'])->name('contact-form.submit');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

Route::middleware('customer.logout')->group(function () {
    Route::get('/customer-dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    Route::post('/customer-logout', [CustomerDashboardController::class, 'logout'])->name('customer.logout');

    Route::post('/profile-update', [CustomerDashboardController::class, 'profileUpdate'])->name('profile.update');
    Route::post('/profile-image-update', [CustomerDashboardController::class, 'profileImageUpdate'])->name('profile.image-update');
    Route::post('/store-active-tab', [CustomerDashboardController::class, 'storeActiveTab'])->name('store.active.tab');

    Route::post('/password-update', [CustomerDashboardController::class, 'passwordUpdate'])->name('password.update');

});


Route::get('/error', function () {
    return view('errors.404');
});


