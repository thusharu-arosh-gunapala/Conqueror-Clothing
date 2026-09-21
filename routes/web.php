<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OrderController;

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\SettingController;


// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');


// Product Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');


// Category Routes
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');


// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');


// Order Routes
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');

Route::post('/order/place', [OrderController::class, 'place'])
    ->name('order.place');

Route::get('/order/success/{order_number}', [OrderController::class, 'success'])
    ->name('orders.success');


// Storage Route
Route::get('/storage/{path}', function (string $path) {

    abort_unless(
        Storage::disk('public')->exists($path),
        404
    );

    return Storage::disk('public')->response($path);

})->where('path', '.*')->name('storage.local');


// Required by Laravel auth middleware
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');


// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {

    // Admin Auth - Public Access
    Route::get('/login', [AdminAuthController::class, 'loginForm'])
        ->name('login');

    Route::post('/login', [AdminAuthController::class, 'login'])
        ->name('login.submit');


    // Admin Protected Routes
    Route::middleware(['auth', 'admin'])->group(function () {

        Route::post('/logout', [AdminAuthController::class, 'logout'])
            ->name('logout');

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');


        // Category Management
        Route::resource('categories', AdminCategoryController::class);


        // Product Management
        Route::resource('products', AdminProductController::class);


        // Order Management
        Route::get('/orders', [AdminOrderController::class, 'index'])
            ->name('orders.index');

        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])
            ->name('orders.show');

        Route::put('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])
            ->name('orders.update-status');

        Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])
            ->name('orders.destroy');

        Route::get('/orders/{order}/print', [AdminOrderController::class, 'print'])
            ->name('orders.print');


        // Settings Management
        Route::get('/settings', [SettingController::class, 'edit'])
            ->name('settings.edit');

        Route::put('/settings', [SettingController::class, 'update'])
            ->name('settings.update');
    });
});