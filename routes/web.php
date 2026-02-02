<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\StatistikController;

// Route Home (Landing Page + Statistik)
Route::get('/', [StatistikController::class, 'index'])->name('home');

// Route Buku Tamu
Route::get('/buku-tamu', [GuestController::class, 'create'])->name('guest.create');
Route::post('/buku-tamu', [GuestController::class, 'store'])->name('guest.store');

// Route Statistik (Opsional, jika ingin akses via /statistik juga)
Route::get('/statistik', [StatistikController::class, 'index'])->name('stats.index');

// Route Rekap
Route::get('/rekap', [GuestController::class, 'rekap'])->name('guest.rekap');