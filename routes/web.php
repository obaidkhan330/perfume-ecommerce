<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminVariationController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\TesterController;




// cronjobs

// use Illuminate\Support\Facades\Artisan;

// Route::get('/sync-storage', function () {
//     Artisan::call('storage:sync');
//     return "Storage synced successfully!";
// });

// cronjobs end


Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('about', function () {
    return view('about');
});





// Cart Routes

Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/add/{slug}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::get('/cart/remove/{key}', [CartController::class, 'removeItem'])->name('cart.remove');
Route::post('/cart/bulk', [CartController::class, 'bulkAdd'])->name('cart.bulk');
// Checkout Route

Route::get('admin/orders', [OrderController::class, 'index'])->name('admin.orders');
// Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
// routes/web.php
Route::put('/admin/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
Route::delete('/admin/orders/{id}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');



// testers
// Admin routes
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('testers', App\Http\Controllers\Admin\TesterController::class);
});



// Admin Panel - Testers CRUD
Route::get('/admin/testers', [TesterController::class, 'index'])->name('admin.testers.index');   // Show all testers
Route::get('/admin/testers/create', [TesterController::class, 'create'])->name('admin.testers.create'); // Show add form
Route::post('/admin/testers', [TesterController::class, 'store'])->name('admin.testers.store');  // Save tester
Route::get('/admin/testers/{id}', [TesterController::class, 'show'])->name('admin.testers.show'); // View single tester
Route::get('/admin/testers/{id}/edit', [TesterController::class, 'edit'])->name('admin.testers.edit'); // Edit form
Route::put('/admin/testers/{id}', [TesterController::class, 'update'])->name('admin.testers.update'); // Update tester
Route::delete('/admin/testers/{id}', [TesterController::class, 'destroy'])->name('admin.testers.destroy'); // Delete tester



// Frontend routes

Route::get('/testers', [App\Http\Controllers\Frontend\TesterController::class, 'index'])->name('testers.index');
Route::get('/testers/{slug}', [App\Http\Controllers\Frontend\TesterController::class, 'show'])->name('testers.show');


Route::post('/cart/add-tester/{id}', [CartController::class, 'addTester'])->name('cart.addTester');





// checkout page dikhane ka route
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.process');
Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders');

Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');




Route::get('contact', function () {
    return view('contact');
});

Route::get('product', function () {
    return view('product');
});

Route::get('details/{slug}', [HomeController::class, 'productDetails'])->name('details');

use App\Http\Controllers\ProductController;

Route::get('shop/{gender?}', [HomeController::class, 'showProducts'])->name('shop');



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
