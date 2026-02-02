<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // Validasi input
        $request->validate([
            'nama_tamu' => 'required',
            'asal_instansi' => 'required',
            'jumlah_personil' => 'required|integer',
            'keperluan' => 'required',
            'penerima_kunjungan' => 'required',
            'tanggal_kunjungan' => 'required|date',
        ]);

        // Insert ke Database
        DB::table('guests')->insert([
            'nama_tamu' => $request->nama_tamu,
            'asal_instansi' => $request->asal_instansi,
            'jumlah_personil' => $request->jumlah_personil,
            'keperluan' => $request->keperluan,
            'penerima_kunjungan' => $request->penerima_kunjungan,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect balik dengan pesan sukses
        return redirect()->route('guest.create')->with('success', 'Data kunjungan berhasil disimpan!');
    }
}