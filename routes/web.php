<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UkmOrmawaController;
use App\Http\Controllers\AlamatController;


// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/Dashboard', [UkmOrmawaController::class, 'index'])->name('ukm-ormawa.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/Dashboard/ukm-ormawa/{slug}', [UkmOrmawaController::class, 'show'])->name('ukm-ormawa.show');
});

Route::middleware(['auth', 'role:pengurus'])->prefix('pengurus')->name('pengurus.')->group(function () {
    Route::get('/ukm-ormawa/kelola', [UkmOrmawaController::class, 'edit'])->name('ukm-ormawa.edit');
    Route::get('/ukm-ormawa/buat', [UkmOrmawaController::class, 'create'])->name('ukm-ormawa.store');
    Route::post('/ukm-ormawa/buat', [UkmOrmawaController::class, 'store'])->name('ukm-ormawa.store');
    Route::put('/ukm-ormawa/kelola', [UkmOrmawaController::class, 'update'])->name('ukm-ormawa.update');
});