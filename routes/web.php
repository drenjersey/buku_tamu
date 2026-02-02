<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;


Route::get('/', function () {
    // 1. CARDS DATA
    $totalGuests = \App\Models\Guest::count();
    $totalThisYear = \App\Models\Guest::whereYear('tanggal_kunjungan', date('Y'))->count();
    $totalThisMonth = \App\Models\Guest::whereMonth('tanggal_kunjungan', date('m'))
        ->whereYear('tanggal_kunjungan', date('Y'))
        ->count();

    // 2. PIE CHART DATA (Agency Composition)
    $pieData = \App\Models\Guest::select('asal_instansi', \DB::raw('count(*) as total'))
        ->groupBy('asal_instansi')
        ->pluck('total', 'asal_instansi');

    // 3. BAR CHART DATA (Monthly - Current Year)
    $monthlyData = collect(range(1, 12))->map(function ($month) {
        return [
            'month' => date("M", mktime(0, 0, 0, $month, 1)), // Jan, Feb...
            'count' => \App\Models\Guest::whereMonth('tanggal_kunjungan', $month)
                ->whereYear('tanggal_kunjungan', date('Y'))
                ->count(),
        ];
    });

    $recentGuests = \App\Models\Guest::latest()->limit(5)->get();

    return view('landing-page', compact('totalGuests', 'totalThisYear', 'totalThisMonth', 'pieData', 'monthlyData', 'recentGuests'));
})->name('home');

// Route Buku Tamu (Zino)
Route::get('/buku-tamu', [GuestController::class, 'create'])->name('guest.create');
Route::post('/buku-tamu', [GuestController::class, 'store'])->name('guest.store');