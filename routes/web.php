<?php




use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminDashboardController;

use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShopProductController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Admin\AdminCategoryController;



Route::get('/', function () {
    return view('index');
});

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
Route::get('product-details', function () {
    return view('details');
});

Route::get('shop', function () {
    return view('shop');
});




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

        Route::resource('users', AdminUserController::class);
        Route::resource('products', AdminProductController::class);
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('orders', AdminOrderController::class);
    });
