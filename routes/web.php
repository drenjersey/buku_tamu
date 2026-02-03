<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\AuthController;

// 1. Landing Page (Sekarang ada Formnya)
Route::get('/', function () {
    return app(GuestController::class)->landingPage(); 
})->name('home');

// 2. Proses Simpan Form
Route::post('/buku-tamu', [GuestController::class, 'store'])->name('guest.store');

// 3. LOGIN CUSTOM
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 4. REKAP & EXPORT (DILINDUNGI PASSWORD / AUTH)
Route::middleware(['auth'])->group(function () {
    Route::get('/rekap', [GuestController::class, 'rekap'])->name('guest.rekap');
    Route::get('/rekap/export', [GuestController::class, 'exportCsv'])->name('guest.export');
});