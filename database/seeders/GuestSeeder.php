<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            $created_at = \Carbon\Carbon::create(2023, 1, 1)->addDays(rand(0, 1200)); // Random date from 2023 to ~2026
            $data[] = [
                'name' => 'Pengunjung ' . ($i + 1),
                'agency' => $agencies[array_rand($agencies)],
                'purpose' => $purposes[array_rand($purposes)],
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ];
        }

        \DB::table('guests')->insert($data);
    }
}
