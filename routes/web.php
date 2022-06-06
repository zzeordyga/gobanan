<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewController;
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
    Route::get('/create', [ServiceController::class, 'create'])->name('create');
    Route::get('/service/{id}/edit', [ServiceController::class, 'edit'])->name('edit');
    Route::post('/service/{id}/addReview', [ReviewController::class, 'store'])->name('store-review');
    Route::post('/addService', [ServiceController::class, 'store'])->name('store');
    Route::patch('/updateService/{id}', [ServiceController::class, 'update'])->name('updateService');
    Route::delete('/deleteService/{id}', [ServiceController::class, 'destroy'])->name('deleteService');

    Route::put('/finishOrder', [TransactionDetailController::class, 'finishOrder'])->name('finishOrder');
});

// Admin Middleawre
Route::middleware(['admin'])->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin-dashboard');
    Route::get('/admin/category', [AdminController::class, 'category'])->name('admin-category');
    Route::get('/admin/review', [AdminController::class, 'review'])->name('admin-review');
    Route::get('/admin/service', [AdminController::class, 'service'])->name('admin-service');
    
    Route::get('/admin/transaction', [AdminController::class, 'transaction'])->name('admin-transaction');
    Route::get('/admin/transaction/{id}/details', [AdminController::class, 'transactionDetail'])->name('admin-transaction-detail');

    Route::get('/admin/user', [AdminController::class, 'user'])->name('admin-user');

    Route::get('/admin/category/create', [CategoryController::class, 'create'])->name('create-category');
    Route::get('/admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('edit-category');
    
    Route::post('/admin/category/store', [CategoryController::class, 'store'])->name('store-category');
    Route::patch('/admin/category/update/{id}', [CategoryController::class, 'update'])->name('update-category');
    Route::patch('/admin/user/makeAdmin/{id}', [UserController::class, 'makeAdmin'])->name('make-user-admin');
    Route::patch('/admin/user/makeMember/{id}', [UserController::class, 'makeMember'])->name('make-user-member');
    
    Route::delete('/admin/category/delete/{id}', [CategoryController::class, 'destroy'])->name('delete-category');
});
