<?php




use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminDashboardController;

use App\Http\Controllers\auth\AuthController;
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

Route::get('shop', function () {
    return view('shop');
});




Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.post');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/order', [OrderController::class, 'store'])->middleware('auth');


Route::middleware(['auth'])->group(function () {
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('order.my');
});




Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/place-order', [OrderController::class, 'store'])->middleware('auth');



// Admin Panel Routes
Route::prefix('admin')->middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products');

    // Categories CRUD
    Route::resource('categories', AdminCategoryController::class)->names('admin.categories');

    // Orders CRUD
    Route::resource('orders', AdminOrderController::class)->names('admin.orders');

    // Users Management (optional)
    Route::resource('users', AdminUserController::class)->names('admin.users');


    Route::prefix('admin')->group(function () {
    Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::post('/products/update/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/delete/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.delete');
});
});






Route::get('/shop', [ShopController::class, 'index'])->name('shop');
// Public product detail route
// Route::get('/product/{id}', [PublicProductController::class, 'show'])->name('product.show');


Route::get('/product/{id}', [ShopProductController::class, 'show'])->name('product.show');













Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/{productId}', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
});


