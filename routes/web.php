<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::resource('products', ProductController::class);

// المسار للدashboard الذي يتطلب تسجيل الدخول
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

// مسار لاختبار
Route::get('/test', function () {
    return 'Hello Laravel!';
});

// المسارات الخاصة بتسجيل الدخول
Auth::routes();

// تعريف المسار /home
Route::get('/home', [HomeController::class, 'index'])->name('home');

// المسار الخاص بالأدمن مع استخدام middleware "admin"
Route::get('/admin', function () {
    return "Bienvenue, Admin !";
})->middleware(\App\Http\Middleware\AdminMiddleware::class);
use App\Http\Controllers\CartController;

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
use App\Http\Controllers\OrderController;

Route::post('/order', [OrderController::class, 'store'])->name('order.store');
