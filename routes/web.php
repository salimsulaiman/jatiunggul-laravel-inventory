<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SaleItemController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/user/search', [UserController::class, 'search'])->name('users.search');
        Route::post('/users', [UserController::class, 'store'])->name('user.post');
        Route::delete('users/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::put('users/{id}', [UserController::class, 'update'])->name('user.put');
    });

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.post');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.put');

    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
    Route::post('/product', [ProductController::class, 'store'])->name('product.post');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.put');

    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::get('/customers/filter', [CustomerController::class, 'filterCustomer'])->name('customers.filter');
    Route::get('/customer/{id}', [CustomerController::class, 'show'])->name('customer.show');
    Route::put('/customer/{id}', [CustomerController::class, 'update'])->name('customer.put');

    Route::get('/saleitems/{id}', [SaleItemController::class, 'show'])->name('sale_item.show');
    Route::put('/saleitems/{id}', [SaleItemController::class, 'update'])->name('sale_item.put');
    Route::delete('/saleitems/{id}', [SaleItemController::class, 'destroy'])->name('sale_item.destroy');

    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    // Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/checkout', [TransactionController::class, 'checkout'])->name('transactions');
    Route::get('/transactions/checkoutEdit/{id}', [TransactionController::class, 'checkoutEdit'])->name('transactions.put');
    Route::put('/transactions/checkoutEdit/{id}', [TransactionController::class, 'transactionEdit'])->name('transaction.put');
    Route::post('/transactions/checkout', [TransactionController::class, 'store'])->name('transactions.checkout');
    Route::put('/transactions/settlement/{id}', [TransactionController::class, 'settlement'])->name('transactions.settlement');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.auth');
});

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
