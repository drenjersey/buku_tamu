<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agencies = ['Dinas Pendidikan', 'Dinas Kesehatan', 'Masyarakat Umum', 'Media Lokal', 'Kementerian Agama', 'Dinas PUPR', 'Bappeda'];
        $purposes = ['Koordinasi', 'Konsultasi', 'Wawancara', 'Pengajuan Proposal', 'Studi Banding', 'Laporan'];

        $data = [];
        for ($i = 0; $i < 150; $i++) {
            $created_at = Carbon::create(2023, 1, 1)->addDays(rand(0, 1200)); // Random date from 2023 to ~2026
            $data[] = [
                'nama_tamu' => 'Pengunjung ' . ($i + 1),
                'asal_instansi' => $agencies[array_rand($agencies)],
                'jumlah_personil' => rand(1, 5),
                'keperluan' => $purposes[array_rand($purposes)],
                'penerima_kunjungan' => 'Bagian Umum',
                'tanggal_kunjungan' => $created_at->format('Y-m-d'),
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ];
        }

        DB::table('guests')->insert($data);
    }
}
