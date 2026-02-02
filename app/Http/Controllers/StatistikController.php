<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use Illuminate\Support\Facades\DB;

class StatistikController extends Controller
{
    public function index()
    {
        // 1. CARDS DATA
        $totalGuests = Guest::count();
        $totalThisYear = Guest::whereYear('tanggal_kunjungan', date('Y'))->count();
        $totalThisMonth = Guest::whereMonth('tanggal_kunjungan', date('m'))
            ->whereYear('tanggal_kunjungan', date('Y'))
            ->count();

        // 2. PIE CHART DATA (Agency Composition)
        $pieData = Guest::select('asal_instansi', DB::raw('count(*) as total'))
            ->groupBy('asal_instansi')
            ->pluck('total', 'asal_instansi');

        // 3. BAR CHART DATA (Monthly - Current Year)
        $monthlyData = collect(range(1, 12))->map(function ($month) {
            return [
                'month' => date("M", mktime(0, 0, 0, $month, 1)), // Jan, Feb...
                'count' => Guest::whereMonth('tanggal_kunjungan', $month)
                    ->whereYear('tanggal_kunjungan', date('Y'))
                    ->count(),
            ];
        });

        $recentGuests = Guest::latest()->limit(5)->get();

        return view('landing-page', compact('totalGuests', 'totalThisYear', 'totalThisMonth', 'pieData', 'monthlyData', 'recentGuests'));
    }
}
