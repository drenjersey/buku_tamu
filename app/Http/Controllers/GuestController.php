<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GuestController extends Controller
{
    // ====================================================
    // 1. HALAMAN DEPAN (LANDING PAGE + STATISTIK)
    // ====================================================
    public function landingPage(Request $request)
    {
        // A. KPI CARD
        $totalGuests = DB::table('guests')->count();
        $totalThisYear = DB::table('guests')->whereYear('created_at', date('Y'))->count();
        $totalThisMonth = DB::table('guests')->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();

        // B. QUERY DATA TABEL
        $queryRecent = DB::table('guests')->orderBy('created_at', 'desc');

        // Filter Pencarian (Search)
        if ($request->filled('search')) {
            $search = $request->search;
            $queryRecent->where(function($q) use ($search) {
                $q->where('nama_tamu', 'like', "%{$search}%")
                  ->orWhere('asal_instansi', 'like', "%{$search}%")
                  ->orWhere('keperluan', 'like', "%{$search}%");
            });
        }

        // Filter Bulan & Tahun
        if ($request->filled('bulan') && $request->filled('tahun')) {
            $queryRecent->whereMonth('created_at', (int)$request->bulan)
                        ->whereYear('created_at', (int)$request->tahun);
        }

        // Default Limit jika tidak ada filter
        if (!$request->filled('search') && !$request->filled('bulan')) {
            $queryRecent->limit(5);
        }

        $recentGuests = $queryRecent->get();

        // Konversi Tanggal ke Carbon
        $recentGuests->transform(function ($guest) {
            $guest->created_at = Carbon::parse($guest->created_at);
            return $guest;
        });

        // [PENTING] Cek Request AJAX
        // Jika request datang dari Javascript, kembalikan hanya tabel (Partial View)
        if ($request->ajax()) {
            return view('partials.guests-table', compact('recentGuests'))->render();
        }
            
        // C. DATA PIE CHART
        $rawPie = DB::table('guests')
            ->select('asal_instansi', DB::raw('count(*) as total'))
            ->groupBy('asal_instansi')
            ->orderByDesc('total')
            ->limit(7)
            ->get();

        $pieData = [];
        foreach ($rawPie as $row) {
            $pieData[$row->asal_instansi] = $row->total;
        }
        
        // D. DATA BAR CHART
        $currentYear = date('Y');
        $rawMonthly = DB::table('guests')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')->orderBy('month')->get();
            
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $found = $rawMonthly->firstWhere('month', $i);
            $monthlyData[] = [
                'month' => Carbon::create()->month($i)->locale('id')->monthName,
                'count' => $found ? $found->total : 0
            ];
        }

        return view('landing-page', compact(
            'totalGuests', 'totalThisYear', 'totalThisMonth', 
            'recentGuests', 'pieData', 'monthlyData'
        ));
    }

    // ====================================================
    // 2. PROSES SIMPAN BUKU TAMU
    // ====================================================
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_kunjungan' => 'required|date',
            'jumlah_personil' => 'required|integer|min:1',
            'nama_tamu' => 'required|string|max:255',
            'asal_instansi' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'penerima_kunjungan' => 'required|string|max:255',
            'keperluan' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('tamu_photos', 'public');
        }

        DB::table('guests')->insert([
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'jumlah_personil' => $request->jumlah_personil,
            'nama_tamu' => $request->nama_tamu,
            'asal_instansi' => $request->asal_instansi,
            'kontak' => $request->kontak,
            'penerima_kunjungan' => $request->penerima_kunjungan,
            'keperluan' => $request->keperluan,
            'foto_path' => $fotoPath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Terima kasih Data kunjungan Anda telah tersimpan.');
    }

    // ====================================================
    // 3. HALAMAN REKAP ADMIN (DEFAULT BULAN INI)
    // ====================================================
    public function rekap(Request $request)
    {
        $query = DB::table('guests');

        // 1. Ambil input dari user
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $search = $request->search;

        // 2. LOGIKA DEFAULT:
        // Jika User TIDAK mengisi tanggal (baru buka halaman), 
        // otomatis set ke tanggal 1 bulan ini sampai hari ini/akhir bulan.
        if (empty($startDate) && empty($endDate) && empty($search)) {
            $startDate = date('Y-m-01'); // Tanggal 1 bulan berjalan
            $endDate = date('Y-m-t');    // Tanggal terakhir bulan berjalan
        }

        // 3. Terapkan Filter Tanggal (Baik dari user maupun default tadi)
        if ($startDate && $endDate) {
            $query->whereBetween('tanggal_kunjungan', [$startDate, $endDate]);
        }

        // 4. Terapkan Pencarian
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_tamu', 'like', "%{$search}%")
                  ->orWhere('asal_instansi', 'like', "%{$search}%");
            });
        }

        // 5. Urutkan & Pagination
        $guests = $query->orderBy('tanggal_kunjungan', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        // Penting: Agar filter tidak hilang saat klik halaman 2, 3, dst.
        $guests->appends([
            'start_date' => $startDate,
            'end_date' => $endDate,
            'search' => $search
        ]);

        // Kirim variabel tanggal ke view agar input date terisi otomatis
        return view('guests.rekap', compact('guests', 'startDate', 'endDate', 'search'));
    }

    // ====================================================
    // 4. EXPORT CSV
    // ====================================================
    public function exportCsv(Request $request)
    {
        $query = DB::table('guests');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_kunjungan', [$request->start_date, $request->end_date]);
        }

        $guests = $query->orderBy('tanggal_kunjungan', 'desc')->get();
        $filename = 'buku-tamu-' . date('Y-m-d-His') . '.csv';

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=\"$filename\"",
        ];

        return response()->stream(function () use ($guests) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['No', 'Tanggal', 'Nama Tamu', 'Instansi', 'Kontak', 'Bertemu', 'Keperluan', 'Jml Personil']);

            $no = 1;
            foreach ($guests as $guest) {
                fputcsv($file, [
                    $no++,
                    $guest->tanggal_kunjungan,
                    $guest->nama_tamu,
                    $guest->asal_instansi,
                    $guest->kontak,
                    $guest->penerima_kunjungan,
                    $guest->keperluan,
                    $guest->jumlah_personil
                ]);
            }
            fclose($file);
        }, 200, $headers);
    }
}