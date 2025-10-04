<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\UserController;

Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::middleware('auth')->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add/{product}', [WishlistController::class, 'store'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{product}', [WishlistController::class, 'destroy'])->name('wishlist.remove');
});



Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/register', function () {
    return view('signup');
})->name('register');
Route::post('/login', [UserController::class, 'loginSubmit'])->name('login.submit');
Route::post('/register', [UserController::class, 'registerSubmit'])->name('register.submit');
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');
