<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminVariationController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('about', function () {
    return view('about');
});


Route::get('cart', function () {
    return view('cart');
});

Route::get('checkout', function () {
    return view('checkout');
});

Route::get('contact', function () {
    return view('contact');
});

Route::get('product', function () {
    return view('product');
});
Route::get('details/{id}', [AdminProductController::class, 'UserProductDetails']);


Route::get('shop', function () {
    return view('shop');
});




Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);


Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.post');
Route::get('/verify-email', [AuthController::class, 'showVerifyForm'])->name('verify.email');
Route::post('/verify-email', [AuthController::class, 'verifyOtp'])->name('verify.email.submit');


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/order', [OrderController::class, 'store'])->middleware('auth');













Route::middleware(['auth'])->group(function () {

    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/{productId}', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
});


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/product', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::post('brands', [AdminProductController::class, 'store'])->name('admin.brands.store');
    Route::put('brands/{id}', [AdminProductController::class, 'update'])->name('admin.brands.update');
    Route::delete('brands/{id}', [AdminProductController::class, 'destroy'])->name('admin.brands.destroy');
    Route::post('product/', [AdminProductController::class, 'storeProduct'])->name('admin.products.store');
    Route::put('product/{id}', [AdminProductController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('product/{id}', [AdminProductController::class, 'destroyProduct'])->name('admin.products.destroy');

    Route::get('variations', [AdminVariationController::class, 'index'])->name('admin.variations.index');
    Route::post('/variations', [AdminVariationController::class, 'store'])->name('admin.variations.store');
    Route::put('/variations/update/{id}', [AdminVariationController::class, 'update'])->name('admin.variations.update');
    Route::delete('/variations/destroy/{id}', [AdminVariationController::class, 'destroy'])->name('admin.variations.destroy');
});



// fetch products
