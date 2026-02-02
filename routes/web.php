<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // 1. CARDS DATA
    $totalGuests = \App\Models\Guest::count();
    $totalThisYear = \App\Models\Guest::whereYear('created_at', date('Y'))->count();
    $totalThisMonth = \App\Models\Guest::whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))
        ->count();

    // 2. PIE CHART DATA (Agency Composition)
    $pieData = \App\Models\Guest::select('agency', \DB::raw('count(*) as total'))
        ->groupBy('agency')
        ->pluck('total', 'agency'); // Returns ['Dinas Pendidikan' => 10, ...]

    // 3. BAR CHART DATA (Monthly - Current Year)
    $monthlyData = collect(range(1, 12))->map(function ($month) {
        return [
            'month' => date("M", mktime(0, 0, 0, $month, 1)), // Jan, Feb...
            'count' => \App\Models\Guest::whereMonth('created_at', $month)
                ->whereYear('created_at', date('Y'))
                ->count(),
        ];
    });

    $recentGuests = \App\Models\Guest::latest()->limit(5)->get();

    return view('welcome', compact('totalGuests', 'totalThisYear', 'totalThisMonth', 'pieData', 'monthlyData', 'recentGuests'));
});
