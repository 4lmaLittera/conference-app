<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\ConferenceController;

require __DIR__.'/auth.php';

Route::get('/', [ConferenceController::class, 'index'])->name('conferences.index');
Route::middleware('auth')->group(function () {
    Route::get('/conferences/create', [ConferenceController::class, 'create'])->name('conferences.create');
    Route::post('/conferences', [ConferenceController::class, 'store'])->name('conferences.store');
    Route::get('/conferences/{conference}/edit', [ConferenceController::class, 'edit'])->name('conferences.edit');
    Route::put('/conferences/{conference}', [ConferenceController::class, 'update'])->name('conferences.update');
    Route::delete('/conferences/{conference}', [ConferenceController::class, 'destroy'])->name('conferences.destroy');
});

Route::get('/conferences/{conference}', [ConferenceController::class, 'show'])->name('conferences.show');
