<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConferenceController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Conference Routes - Public
Route::get('/', [ConferenceController::class, 'index'])->name('conferences.index');

// Authenticated Routes - Must come before {conference} wildcard route
Route::middleware('auth')->group(function () {
    Route::get('/conferences/create', [ConferenceController::class, 'create'])->name('conferences.create');
    Route::post('/conferences', [ConferenceController::class, 'store'])->name('conferences.store');
    Route::get('/conferences/{conference}/edit', [ConferenceController::class, 'edit'])->name('conferences.edit');
    Route::put('/conferences/{conference}', [ConferenceController::class, 'update'])->name('conferences.update');
    Route::delete('/conferences/{conference}', [ConferenceController::class, 'destroy'])->name('conferences.destroy');
});

// Conference show route - must come AFTER specific routes
Route::get('/conferences/{conference}', [ConferenceController::class, 'show'])->name('conferences.show');
