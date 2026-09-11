<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\PaymentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::resource('/products', ProductController::class)
        ->except(['show'])
        ->names('admin.products');

    Route::get('/orders', [OrderController::class, 'index'])
        ->name('admin.orders.index');

    Route::get('/orders/{order}', [OrderController::class, 'show'])
        ->name('admin.orders.show');

    Route::post(
    '/orders/{order}/confirm-payment',
    [\App\Http\Controllers\Admin\OrderController::class, 'confirmPayment']
    )->name('admin.orders.confirm-payment');

    Route::post(
    '/orders/{order}/complete',
    [\App\Http\Controllers\Admin\OrderController::class, 'completeOrder']
    )->name('admin.orders.complete');

    Route::get('/customers', [CustomerController::class, 'index'])
        ->name('admin.customers.index');

    Route::get('/reports', [ReportController::class, 'index'])
        ->name('admin.reports.index');

});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/keranjang', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('/keranjang/tambah/{product}', [CartController::class, 'add'])
    ->name('cart.add');

Route::patch('/keranjang/{id}', [CartController::class, 'update'])
    ->name('cart.update');

Route::delete('/keranjang/{id}', [CartController::class, 'remove'])
    ->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'index'])
    ->middleware('auth')
    ->name('checkout.index');

Route::post('/checkout', [CheckoutController::class, 'store'])
    ->middleware('auth')
    ->name('checkout.store');

Route::get('/payment/{order}', [PaymentController::class, 'show'])
    ->middleware('auth')
    ->name('payment.show');

Route::middleware('auth')->group(function () {

    Route::get('/pesanan-saya', [CustomerOrderController::class, 'index'])
        ->name('customer.orders.index');

    Route::get('/pesanan-saya/{order}', [CustomerOrderController::class, 'show'])
        ->name('customer.orders.show');

});

require __DIR__.'/auth.php';
