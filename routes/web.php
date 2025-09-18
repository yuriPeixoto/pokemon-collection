<?php

use App\Http\Controllers\PokemonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FastMoveController;
use App\Http\Controllers\Admin\ChargeMoveController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return redirect()->route('pokemon.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pokemon routes
    Route::resource('pokemon', PokemonController::class);

    // Rota de teste simples
    Route::post('pokemon/search-api', [PokemonController::class, 'searchApi'])->name('pokemon.search.api');
});

// Admin routes
Route::middleware(['auth', 'super-admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('fast-moves', FastMoveController::class);
    Route::resource('charge-moves', ChargeMoveController::class);
});

require __DIR__.'/auth.php';
