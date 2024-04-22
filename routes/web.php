<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::middleware('auth')->group(function () {
    Route::get('/', [ItemController::class, 'index'])->name('home');
    Route::get('/item/create', [ItemController::class, 'create'])->name('create');
    Route::post('/item/create', [ItemController::class, 'store'])->name('store');
    Route::get('/item/{id}', [ItemController::class, 'show'])->name('show');
    Route::get('/item/{id}/edit', [ItemController::class, 'edit'])->name('edit');
    Route::put('/item/{id}', [ItemController::class, 'update'])->name('update');
    Route::get('/item/{id}/add-price', [ItemController::class, 'addPrice'])->name('add.price');
    Route::post('/item/{id}/add-price', [ItemController::class, 'storePrice'])->name('store.price');
    Route::get('/search', [ItemController::class, 'search'])->name('search');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    //Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);
});

require __DIR__.'/auth.php';
