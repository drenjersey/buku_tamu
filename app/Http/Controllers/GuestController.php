<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Guest;

class GuestController extends Controller
{
    // 1. Menampilkan Halaman Form
    public function create()
    {
        return view('guests.create'); // Mengarah ke file resources/views/guests/create.blade.php
    }

    // 2. Menyimpan Data ke Database 'buku_tamu' -> tabel 'guests'
    public function store(Request $request)
    {
       // Tambahkan validasi foto
        $request->validate([
            'nama_tamu' => 'required',
            'asal_instansi' => 'required',
            'jumlah_personil' => 'required|integer',
            'keperluan' => 'required',
            'penerima_kunjungan' => 'required', // Wajib
            'tanggal_kunjungan' => 'required|date',
            'foto' => 'required|image|max:2048', // WAJIB ADA FOTO (Maks 2MB)
        ]);

        // Handle Upload Foto
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            // Simpan di folder public/storage/uploads
            $fotoPath = $request->file('foto')->store('uploads', 'public');
        }

        // Insert ke Database
        DB::table('guests')->insert([
            'nama_tamu' => $request->nama_tamu,
            'asal_instansi' => $request->asal_instansi,
            'jumlah_personil' => $request->jumlah_personil,
            'keperluan' => $request->keperluan,
            'penerima_kunjungan' => $request->penerima_kunjungan,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'foto' => $fotoPath, // Simpan path foto
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect balik dengan pesan sukses
        return redirect()->route('home')->with('success', 'Data kunjungan berhasil disimpan!');
    }

    // 3. Menampilkan Halaman Rekap
    public function rekap(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $query = DB::table('guests');

        if ($startDate) {
            $query->whereDate('tanggal_kunjungan', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('tanggal_kunjungan', '<=', $endDate);
        }

        $guests = $query->orderBy('tanggal_kunjungan', 'desc')->paginate(10);

        return view('guests.rekap', compact('guests', 'startDate', 'endDate'));
    }

    public function exportCsv(Request $request)
{
    // 1. Ambil Filter Tanggal (Sama persis dengan logika rekap)
    $query = Guest::query();

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('tanggal_kunjungan', [
            $request->start_date, 
            $request->end_date
        ]);
    }

    // 2. Ambil semua data (JANGAN dipaginate, karena kita mau download semua)
    $guests = $query->orderBy('tanggal_kunjungan', 'desc')->get();

    // 3. Buat Nama File Unik
    $filename = 'rekap-kunjungan-' . date('Y-m-d-His') . '.csv';

    // 4. Stream Download (Teknik hemat memori)
    $headers = [
        "Content-Type" => "text/csv",
        "Content-Disposition" => "attachment; filename=\"$filename\"",
    ];

    return response()->stream(function () use ($guests) {
        $file = fopen('php://output', 'w');

        // Header Kolom CSV (Baris Pertama)
        fputcsv($file, [
            'No', 
            'Tanggal Kunjungan', 
            'Nama Tamu', 
            'Asal Instansi', 
            'Jumlah Personil', 
            'Keperluan', 
            'Bertemu Dengan'
        ]);

        // Isi Data (Looping)
        $no = 1;
        foreach ($guests as $guest) {
            fputcsv($file, [
                $no++,
                $guest->tanggal_kunjungan,
                $guest->nama_tamu,
                $guest->asal_instansi,
                $guest->jumlah_personil,
                $guest->keperluan,
                $guest->penerima_kunjungan
            ]);
        }

        fclose($file);
    }, 200, $headers);
}

public function landingPage()
{
    $totalGuests = \App\Models\Guest::count();
    $totalThisYear = \App\Models\Guest::whereYear('created_at', date('Y'))->count();
    $totalThisMonth = \App\Models\Guest::whereMonth('created_at', date('m'))->count();
    $recentGuests = \App\Models\Guest::latest()->take(5)->get();
    
    // Data Grafik (Pie & Bar) - Sesuaikan dengan logika statistik Anda
    $pieData = []; 
    $monthlyData = [];

    return view('landing-page', compact('totalGuests', 'totalThisYear', 'totalThisMonth', 'recentGuests', 'pieData', 'monthlyData'));
}

}