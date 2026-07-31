<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TransactionDetailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ServiceController::class, 'index'])->name('home');

Route::get('/explore', [ServiceController::class, 'explore'])->name('explore');
Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show')->whereNumber('id');
Route::get('/category/{id}', [ServiceController::class, 'category'])->name('category')->whereNumber('id');
Route::get('/search', [ServiceController::class, 'search'])->name('search');
Route::get('/u/{id}', [ServiceController::class, 'userServices'])->name('users.show')->whereNumber('id');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    Route::get('/orders', [ServiceController::class, 'orders'])->name('orders');
    Route::put('/orders/finish', [TransactionDetailController::class, 'finish'])->name('orders.finish');

    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit')->whereNumber('id');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::patch('/services/{id}', [ServiceController::class, 'update'])->name('services.update')->whereNumber('id');
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy')->whereNumber('id');

    Route::post('/services/{id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::get('/categories', [AdminController::class, 'categories'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit')->whereNumber('id');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::patch('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update')->whereNumber('id');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy')->whereNumber('id');

    Route::get('/reviews', [AdminController::class, 'reviews'])->name('reviews.index');
    Route::get('/services', [AdminController::class, 'services'])->name('services.index');
    Route::get('/transactions', [AdminController::class, 'transactions'])->name('transactions.index');
    Route::get('/transactions/{id}', [AdminController::class, 'transactionDetails'])->name('transactions.show')->whereNumber('id');
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::patch('/users/{id}/make-admin', [UserController::class, 'makeAdmin'])->name('users.make-admin')->whereNumber('id');
    Route::patch('/users/{id}/make-member', [UserController::class, 'makeMember'])->name('users.make-member')->whereNumber('id');
});

require __DIR__.'/auth.php';
