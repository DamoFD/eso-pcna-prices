<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ItemController::class, 'index'])->name('home');

Route::get('/item/create', [ItemController::class, 'create'])->name('create');

Route::post('/item/create', [ItemController::class, 'store'])->name('store');

Route::get('/item/{id}', [ItemController::class, 'show'])->name('show');

Route::get('/item/{id}/edit', [ItemController::class, 'edit'])->name('edit');

Route::put('/item/{id}', [ItemController::class, 'update'])->name('update');

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/search', [ItemController::class, 'search'])->name('search');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
