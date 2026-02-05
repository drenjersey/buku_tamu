<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AttendanceController extends Controller
{
    // ====================================================================
    // KONFIGURASI MULTI-LOKASI KANTOR
    // ====================================================================

    private $officeLocations = [
        [
            'name' => 'Gedung Utama Walikota',
            'lat' => -8.583271,
            'lng' => 116.108032,
            'radius' => 3000
        ],
        [
            'name' => 'Gedung B (Belakang)',
            'lat' => -8.583500,
            'lng' => 116.108200,
            'radius' => 3000
        ],
        [
            'name' => 'Area Parkir & Gerbang',
            'lat' => -8.583100,
            'lng' => 116.107900,
            'radius' => 3000
        ],
    ];

    // ====================================================================

    public function dashboard()
    {
        $user = Auth::user();
        $today = date('Y-m-d');

        $tamuCount = DB::table('guests')->whereDate('tanggal_kunjungan', $today)->count();

        $attendance = null;
        if ($user->role !== 'superadmin') {
            $attendance = DB::table('attendances')
                ->where('user_id', $user->id)
                ->where('date', $today)
                ->first();
        }

        return view('dashboard.index', [
            'user' => $user,
            'attendance' => $attendance,
            'tamuCount' => $tamuCount,
            'officeLocations' => $this->officeLocations
        ]);
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $earthRadius * $c;
    }

    private function checkLocation($userLat, $userLng)
    {
        $closestDistance = 999999;
        $closestLocation = '';
        $isInside = false;

        foreach ($this->officeLocations as $loc) {
            $distance = $this->calculateDistance($userLat, $userLng, $loc['lat'], $loc['lng']);

            if ($distance < $closestDistance) {
                $closestDistance = $distance;
                $closestLocation = $loc['name'];
            }

            if ($distance <= $loc['radius']) {
                $isInside = true;
                $closestDistance = $distance;
                $closestLocation = $loc['name'];
                break;
            }
        }

        return [
            'status' => $isInside,
            'distance' => $closestDistance,
            'location_name' => $closestLocation
        ];
    }

    // --- ABSEN HARIAN (Sekali Saja) ---
    public function checkIn(Request $request)
    {
        $request->validate(['latitude' => 'required', 'longitude' => 'required']);

        $check = $this->checkLocation($request->latitude, $request->longitude);

        if (!$check['status']) {
            return back()->with('error', "Gagal Absen! Anda berada " . round($check['distance']) . "m dari titik terdekat (" . $check['location_name'] . "). Silakan mendekat.");
        }

        $userId = Auth::id();
        $today = date('Y-m-d');

        // Cek apakah sudah absen hari ini?
        if (DB::table('attendances')->where('user_id', $userId)->where('date', $today)->exists()) {
            return back()->with('error', 'Anda sudah melakukan absensi hari ini!');
        }

        DB::table('attendances')->insert([
            'user_id' => $userId,
            'date' => $today,
            'check_in' => now(), // Hanya mencatat waktu masuk/hadir
            'check_out' => null, // Tidak perlu jam pulang
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => 'Hadir',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', "Absensi Berhasil! Terdeteksi di: " . $check['location_name']);
    }

    // --- ABSEN PULANG ---
    public function checkOut(Request $request)
    {
        $request->validate(['latitude' => 'required', 'longitude' => 'required']);

        // Check Time (Only after 17:00 WITA)
        if (now()->setTimezone('Asia/Makassar')->hour < 17) {
            return back()->with('error', 'Anda hanya bisa absen pulang pada saat jam 17:00 WITA 😤🗿');
        }

        $check = $this->checkLocation($request->latitude, $request->longitude);

        if (!$check['status']) {
            return back()->with('error', "Gagal Absen Pulang! Anda berada di luar radius.");
        }

        $userId = Auth::id();
        $today = date('Y-m-d');

        // Cek apakah sudah absen masuk hari ini?
        $attendance = DB::table('attendances')
            ->where('user_id', $userId)
            ->where('date', $today)
            ->first();

        if (!$attendance) {
            return back()->with('error', 'Anda belum melakukan absen masuk hari ini!');
        }

        if ($attendance->check_out) {
            return back()->with('error', 'Anda sudah melakukan absen pulang hari ini!');
        }

        DB::table('attendances')->where('id', $attendance->id)->update([
            'check_out' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', "Terima Kasih Anda sudah melaksanakan tugas hari ini 😊");
    }

    // --- REKAP DATA ---
    public function rekap(Request $request)
    {
        $userId = $request->user_id;
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $search = $request->search;

        // 1. Logika Auto-Filter 30 Hari (Jika user dipilih tapi tanggal kosong)
        if (($userId || $search) && empty($startDate) && empty($endDate)) {
            $startDate = now()->subDays(30)->format('Y-m-d');
            $endDate = now()->format('Y-m-d');
        }

        $query = DB::table('attendances')
            ->join('users', 'attendances.user_id', '=', 'users.id')
            ->select('attendances.*', 'users.name');

        if ($userId) {
            $query->where('attendances.user_id', $userId);
        }

        if ($search) {
            $query->where('users.name', 'like', "%{$search}%");
        }

        if ($startDate && $endDate) {
            $query->whereBetween('attendances.date', [$startDate, $endDate]);
        }

        $rekap = $query->orderBy('attendances.date', 'desc')->paginate(5);
        $users = DB::table('users')->where('role', '!=', 'superadmin')->select('id', 'name')->get();

        return view('dashboard.rekap-absensi', compact('rekap', 'users', 'startDate', 'endDate', 'search'));
    }

    // --- EXPORT CSV (DENGAN PERBAIKAN TIMEZONE WITA) ---
    public function exportCsv(Request $request)
    {
        $query = DB::table('attendances')
            ->join('users', 'attendances.user_id', '=', 'users.id')
            ->select('attendances.*', 'users.name');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('attendances.date', [$request->start_date, $request->end_date]);
        }

        $attendances = $query->orderBy('attendances.date', 'desc')->get();
        $filename = 'absensi-harian-' . date('Y-m-d-His') . '.csv';

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=\"$filename\"",
        ];

        return response()->stream(function () use ($attendances) {
            $file = fopen('php://output', 'w');

            // Header CSV
            fputcsv($file, ['No', 'Tanggal', 'Nama Petugas', 'Masuk', 'Pulang', 'Lokasi Absen', 'Link Peta']);

            $no = 1;
            foreach ($attendances as $row) {
                // FIX: Konversi Waktu dari UTC ke WITA (Asia/Makassar)
                $masuk = $row->check_in
                    ? \Carbon\Carbon::parse($row->check_in, 'UTC')->setTimezone('Asia/Makassar')->format('H:i:s')
                    : '-';

                $pulang = $row->check_out
                    ? \Carbon\Carbon::parse($row->check_out, 'UTC')->setTimezone('Asia/Makassar')->format('H:i:s')
                    : '-';

                $mapsLink = "https://www.google.com/maps?q={$row->latitude},{$row->longitude}";

                fputcsv($file, [
                    $no++,
                    $row->date,
                    $row->name,
                    $masuk,
                    $pulang,
                    $mapsLink,
                    $mapsLink
                ]);
            }
            fclose($file);
        }, 200, $headers);
    }
}