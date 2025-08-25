<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;


use Illuminate\Support\Facades\Route;

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

