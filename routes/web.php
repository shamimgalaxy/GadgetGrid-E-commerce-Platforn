<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GadgetGridController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;

Route::get('/', [GadgetGridController::class, 'index']);

Route::get('/category', [GadgetGridController::class, 'category'])->name('product-category');

Route::get('/detail', [GadgetGridController::class, 'detail'])->name('product-detail');

Route::get('/show-cart', [CartController::class, 'index'])->name('show-cart');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
