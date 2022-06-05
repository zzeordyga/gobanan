<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TransactionDetailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ServiceController::class, 'index'])->name('dashboard');

Route::get('/explore', [ServiceController::class, 'explore'])->name('explore');

Route::get('/service/{id}', [ServiceController::class, 'show'])->name('service');

Route::get('/category/{id}', [ServiceController::class, 'category'])->name('category');

Route::get('/search', [ServiceController::class, 'search'])->name('search');

Route::get('/user/{id}', [UserController::class, 'show'])->name('user');

Route::get('/user/{id}/services', [ServiceController::class, 'userServices'])->name('user-services');

Route::get('/error', function() {
    return view('pages.error');
})->name('error');

// Member Middleware
Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/addToCart', [CartController::class, 'store'])->name('addToCart');
    Route::post('/checkout', [CartController::class, 'create'])->name('checkout');
    Route::delete('/deleteCart', [CartController::class, 'destroy'])->name('deleteCart');

    Route::get('/orders', [ServiceController::class, 'orders'])->name('orders');
    Route::put('/finishOrder', [TransactionDetailController::class, 'finishOrder'])->name('finishOrder');
});

// Admin Middleawre
Route::middleware(['admin'])->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin-dashboard');
    Route::get('/admin/category', [AdminController::class, 'index'])->name('admin-category');
    Route::get('/admin/review', [AdminController::class, 'index'])->name('admin-review');
    Route::get('/admin/service', [AdminController::class, 'index'])->name('admin-service');
    Route::get('/admin/transaction', [AdminController::class, 'index'])->name('admin-transaction');
    Route::get('/admin/user', [AdminController::class, 'index'])->name('admin-user');
    Route::get('/admin/profile', [AdminController::class, 'index'])->name('admin-profile');
});
