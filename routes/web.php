<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\Auth\AuthController;

// Admin Controllers
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminVariationController;
use App\Http\Controllers\Admin\TesterController as AdminTesterController;
use App\Http\Controllers\AdminSummerDealController;
use App\Http\Controllers\Admin\AdminNotificationController;

// Frontend Controllers
use App\Http\Controllers\SummerDealController;
use App\Http\Controllers\Frontend\TesterController as FrontendTesterController;
use App\Http\Controllers\User\UserNotificationController;


/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Static Pages
Route::get('about', fn() => view('about'));
Route::get('contact', fn() => view('contact'));
Route::get('product', fn() => view('product'));

// Products
Route::get('male/{gender?}', [HomeController::class, 'maleProducts'])->name('male');
Route::get('brands/{brand:slug}', [HomeController::class, 'brandProducts'])->name('brands.details');
Route::get('details/{slug}', [HomeController::class, 'productDetails'])->name('details');
Route::get('shop/{gender?}', [HomeController::class, 'showProducts'])->name('shop');

// Cart
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/add/{slug}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/{slug}/buy-now', [CartController::class, 'buyNow'])->name('cart.buyNow');
Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::get('/cart/remove/{key}', [CartController::class, 'removeItem'])->name('cart.remove');
Route::post('/cart/bulk', [CartController::class, 'bulkAdd'])->name('cart.bulk');
Route::post('/cart/add-tester/{id}', [CartController::class, 'addTester'])->name('cart.addTester');

// Checkout (User can order without login)
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.process');
// Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

// Orders
Route::post('/order', [OrderController::class, 'store'])->name('order.store'); // no auth
Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');
Route::get('/user/order-status/{id}', [OrderController::class, 'getOrderStatus'])->name('orders.status');

// Testers (Frontend)
Route::get('/testers', [FrontendTesterController::class, 'index'])->name('testers.index');
Route::get('/testers/{slug}', [FrontendTesterController::class, 'show'])->name('testers.show');

// Summer Deals (Frontend)
Route::get('/summer-deals', [SummerDealController::class, 'index'])->name('summer-deals.index');

// Auth Routes
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.post');
Route::get('/verify-email', [AuthController::class, 'showVerifyForm'])->name('verify.email');
Route::post('/verify-email', [AuthController::class, 'verifyOtp'])->name('verify.email.submit');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


/*
| Authenticated User Routes
*/
Route::middleware(['auth'])->group(function () {
    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/{productId}', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{productId}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

});


/*

| Admin Routes (Requires Auth)

*/
Route::prefix('admin')->middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Products & Brands
    Route::get('/product', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::post('/brands', [AdminProductController::class, 'store'])->name('admin.brands.store');
    Route::put('/brands/{id}', [AdminProductController::class, 'update'])->name('admin.brands.update');
    Route::delete('/brands/{id}', [AdminProductController::class, 'destroy'])->name('admin.brands.destroy');
    Route::post('/product', [AdminProductController::class, 'storeProduct'])->name('admin.products.store');
    Route::put('/product/{id}', [AdminProductController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/product/{id}', [AdminProductController::class, 'destroyProduct'])->name('admin.products.destroy');

    // Variations
    Route::get('/variations', [AdminVariationController::class, 'index'])->name('admin.variations.index');
    Route::post('/variations', [AdminVariationController::class, 'store'])->name('admin.variations.store');
    Route::put('/variations/update/{id}', [AdminVariationController::class, 'update'])->name('admin.variations.update');
    Route::delete('/variations/destroy/{id}', [AdminVariationController::class, 'destroy'])->name('admin.variations.destroy');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');

    // Testers (Admin CRUD)
    Route::resource('testers', AdminTesterController::class)->names([
        'index'   => 'admin.testers.index',
        'create'  => 'admin.testers.create',
        'store'   => 'admin.testers.store',
        'show'    => 'admin.testers.show',
        'edit'    => 'admin.testers.edit',
        'update'  => 'admin.testers.update',
        'destroy' => 'admin.testers.destroy',
    ]);

    // Summer Deals (Admin)
    Route::get('/summer-deals', [AdminSummerDealController::class, 'index'])->name('admin.summer-deals.index');
    Route::post('/summer-deals', [AdminSummerDealController::class, 'store'])->name('admin.summer-deals.store');
    Route::put('/summer-deals/{id}', [AdminSummerDealController::class, 'update'])->name('admin.summer-deals.update');
    Route::delete('/summer-deals/{id}', [AdminSummerDealController::class, 'destroy'])->name('admin.summer-deals.destroy');

    // Notifications (Admin)
    Route::get('/notifications/fetch', [AdminNotificationController::class, 'fetch'])->name('admin.notifications.fetch');
    Route::delete('/notifications/delete/{id}', [AdminNotificationController::class, 'delete'])->name('admin.notifications.delete');
});
