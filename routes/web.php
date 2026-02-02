<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;


Route::get('/', function () {
    return view('landing-page');
})->name('home');

// Route Buku Tamu (Zino)
Route::get('/buku-tamu', [GuestController::class, 'create'])->name('guest.create');
Route::post('/buku-tamu', [GuestController::class, 'store'])->name('guest.store');