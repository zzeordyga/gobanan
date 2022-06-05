<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceController;
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

// Member Middleware
Route::middleware(['auth:sanctum'])->group(function() {
    Route::post('/addToCart', [CartController::class, 'store'])
    ->name('addToCart');
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
