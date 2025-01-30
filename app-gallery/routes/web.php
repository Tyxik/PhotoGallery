<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;

// Veřejná cesta pro zobrazení hlavní stránky s fotkami (s filtrováním podle názvu a řazení)
Route::get('/', [PhotoController::class, 'welcome'])->name('welcome');

// Skupina tras chráněná middleware 'auth'
Route::middleware(['auth'])->group(function () {
    // Cesta pro zobrazení galerie (s filtrováním podle názvu a řazení)
    Route::get('/photos', [PhotoController::class, 'index'])->name('photos.index');
    // Cesta pro ukládání nové fotky
    Route::post('/photos', [PhotoController::class, 'store'])->name('photos.store');
    // Cesta pro mazání fotky
    Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');
});

// Cesta pro zobrazení dashboardu
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Skupina tras pro profil uživatele
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Zahrnutí tras pro autentizaci
require __DIR__.'/auth.php';
