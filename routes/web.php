<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\UserController;

// 1. TAMU (PUBLIC - TIDAK PERLU LOGIN)
// Menggunakan array [Class, Method] agar Request injection berfungsi otomatis
Route::get('/', [GuestController::class, 'landingPage'])->name('home');
Route::post('/buku-tamu', [GuestController::class, 'store'])->name('guest.store');

// 2. LOGIN / LOGOUT PETUGAS
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 3. AREA KHUSUS PETUGAS (DASHBOARD & ADMIN)
Route::middleware(['auth'])->group(function () {
    
    // A. Dashboard Utama
    Route::get('/dashboard', [AttendanceController::class, 'dashboard'])->name('dashboard');
    
    // B. Fitur Absensi
    Route::post('/absen/masuk', [AttendanceController::class, 'checkIn'])->name('absen.masuk');
    Route::post('/absen/pulang', [AttendanceController::class, 'checkOut'])->name('absen.pulang');
    
    // C. Halaman Laporan / Rekap Absensi
    Route::get('/rekap-absensi', [AttendanceController::class, 'rekap'])->name('absen.rekap');
    Route::get('/rekap-absensi/export', [AttendanceController::class, 'exportCsv'])->name('absen.export');
    
    // D. Rekap Buku Tamu
    Route::get('/rekap', [GuestController::class, 'rekap'])->name('guest.rekap');
    Route::get('/rekap/export', [GuestController::class, 'exportCsv'])->name('guest.export');

    // E. Manajemen User
    Route::resource('users', UserController::class);
});