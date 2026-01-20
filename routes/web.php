<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsoleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;

// Page d'accueil - Liste des consoles
Route::get('/', [ConsoleController::class, 'index'])->name('home');

// Routes d'authentification
Auth::routes();

// Dashboard utilisateur
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

// Routes publiques des consoles
Route::get('/consoles', [ConsoleController::class, 'index'])->name('consoles.index');
Route::get('/consoles/{console}', [ConsoleController::class, 'show'])->name('consoles.show');

// Routes admin (création, modification, suppression)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/consoles/create', [ConsoleController::class, 'create'])->name('consoles.create');
    Route::post('/admin/consoles', [ConsoleController::class, 'store'])->name('consoles.store');
    Route::get('/admin/consoles/{console}/edit', [ConsoleController::class, 'edit'])->name('consoles.edit');
    Route::put('/admin/consoles/{console}', [ConsoleController::class, 'update'])->name('consoles.update');
    Route::delete('/admin/consoles/{console}', [ConsoleController::class, 'destroy'])->name('consoles.destroy');
});

// Routes du panier (authentifié)
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{console}', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');
});
