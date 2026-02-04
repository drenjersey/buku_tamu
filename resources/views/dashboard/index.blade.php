@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<div class="min-h-screen bg-slate-50/50 py-8 relative">
    <div class="absolute top-0 left-0 w-full h-64 bg-gradient-to-b from-blue-600 to-blue-800 -z-10 rounded-b-[3rem] shadow-2xl"></div>

    <div class="container mx-auto px-4 md:px-8 relative z-10">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-12 text-white">
            <div class="flex items-center gap-5">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight">Halo, {{ Auth::user()->name }}</h1>
                    <p class="text-blue-100 font-medium opacity-90">
                        {{ Auth::user()->role == 'superadmin' ? 'Super Administrator Access' : 'Petugas Pelayanan Piket' }}
                    </p>
                </div>
            </div>
            
            <form action="{{ route('logout') }}" method="POST" class="mt-4 md:mt-0">
                @csrf 
                <button type="submit" class="bg-white/10 hover:bg-white/20 text-white px-6 py-3 rounded-xl font-semibold transition backdrop-blur-sm border border-white/20 flex items-center gap-2 group">
                    <span>Logout Sistem</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>
        </div>

        @if(session('success'))
            <div class="bg-green-500 text-white px-6 py-4 rounded-2xl mb-8 shadow-lg shadow-green-500/20 font-medium flex items-center gap-3 animate-fade-in-down">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-500 text-white px-6 py-4 rounded-2xl mb-8 shadow-lg shadow-red-500/20 font-medium flex items-center gap-3 animate-fade-in-down">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ session('error') }}
            </div>
        @endif

        @if(Auth::user()->role == 'superadmin')
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('users.index') }}" class="group bg-white p-8 rounded-3xl shadow-xl hover:shadow-2xl transition duration-300 border border-slate-100 relative overflow-hidden">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-red-50 rounded-bl-full -mr-8 -mt-8 transition group-hover:scale-110"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center mb-6 shadow-sm">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800">Kelola Pengguna</h3>
                        <p class="text-slate-500 mt-2 text-sm leading-relaxed">Manajemen akun petugas dan hak akses sistem.</p>
                    </div>
                </a>

                <a href="{{ route('absen.rekap') }}" class="group bg-white p-8 rounded-3xl shadow-xl hover:shadow-2xl transition duration-300 border border-slate-100 relative overflow-hidden">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-purple-50 rounded-bl-full -mr-8 -mt-8 transition group-hover:scale-110"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center mb-6 shadow-sm">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800">Laporan Absensi</h3>
                        <p class="text-slate-500 mt-2 text-sm leading-relaxed">Rekapitulasi kehadiran harian seluruh pegawai.</p>
                    </div>
                </a>

                <a href="{{ route('guest.rekap') }}" class="group bg-white p-8 rounded-3xl shadow-xl hover:shadow-2xl transition duration-300 border border-slate-100 relative overflow-hidden">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-blue-50 rounded-bl-full -mr-8 -mt-8 transition group-hover:scale-110"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-sm">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800">Laporan Buku Tamu</h3>
                        <p class="text-slate-500 mt-2 text-sm leading-relaxed">Statistik pengunjung harian dan bulanan.</p>
                    </div>
                </a>
            </div>

        @else
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <div class="lg:col-span-4 space-y-6">
                    
                    <div class="bg-white rounded-xl shadow-xl border border-slate-100 overflow-hidden relative">
                        <div class="bg-slate-50 p-6 border-b border-slate-100 flex justify-between items-center">
                            <div>
                                <h3 class="font-bold text-slate-800 text-lg">Panel Kehadiran</h3>
                                <p class="text-xs text-slate-400 font-medium uppercase tracking-wider mt-1">{{ date('l, d F Y') }}</p>
                            </div>
                            <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                        </div>

                        <div class="p-6">
                            <div class="text-center mb-6">
                                <div id="digital-clock" class="text-5xl font-black text-slate-800 tracking-tight font-mono">--:--</div>
                                <span class="text-sm text-slate-400 font-medium">Waktu Indonesia Tengah (WITA)</span>
                            </div>

                            <div class="relative rounded-2xl overflow-hidden shadow-inner border border-slate-200 mb-6 group">
                                <div id="map" class="w-full h-48 z-0"></div>
                                <div class="absolute top-2 right-2 z-[400]">
                                    <div id="gps-indicator" class="bg-white/90 backdrop-blur text-[10px] font-bold px-2 py-1 rounded-lg shadow-sm text-slate-600 flex items-center gap-1">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full animate-ping"></div>
                                        GPS Aktif
                                    </div>
                                </div>
                            </div>

                            <div id="location-status" class="mb-4">
                                <div class="animate-pulse flex flex-col items-center justify-center p-4 bg-slate-50 rounded-xl">
                                    <div class="h-2 w-32 bg-slate-200 rounded mb-2"></div>
                                    <div class="h-2 w-20 bg-slate-200 rounded"></div>
                                </div>
                            </div>

                            @if(!$attendance)
                                <form action="{{ route('absen.masuk') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="latitude" id="input-lat">
                                    <input type="hidden" name="longitude" id="input-lng">
                                    <button type="submit" id="btn-absen" disabled class="w-full py-4 rounded-xl font-bold text-white shadow-lg transition-all transform active:scale-95 flex items-center justify-center gap-2 bg-slate-300 cursor-not-allowed">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                        SCAN KEHADIRAN
                                    </button>
                                </form>
                            @else
                                <div class="bg-gradient-to-br from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-6 text-center relative overflow-hidden">
                                    <div class="absolute top-0 right-0 -mt-2 -mr-2 w-16 h-16 bg-green-200 rounded-full blur-xl opacity-50"></div>
                                    
                                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm border border-green-100">
                                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                    <h4 class="font-bold text-green-800 text-lg">Absensi Berhasil</h4>
                                    <p class="text-sm text-green-600 mb-2">Terima kasih atas dedikasi Anda.</p>
                                    <div class="inline-block bg-white px-4 py-1 rounded-full text-xs font-mono font-bold text-green-700 border border-green-200">
                                        {{ \Carbon\Carbon::parse($attendance->check_in)->timezone('Asia/Makassar')->format('H:i') }} WITA
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <a href="{{ route('guest.rekap') }}" class="group relative bg-white rounded-xl p-8 shadow-xl hover:shadow-2xl transition duration-300 border border-slate-100 overflow-hidden flex flex-col justify-between h-64">
                            <div class="absolute right-0 bottom-0 opacity-5 transform translate-y-4 translate-x-4 group-hover:scale-110 transition duration-500">
                                <svg class="w-40 h-40 text-blue-900" fill="currentColor" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>

                            <div class="relative z-10">
                                <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 mb-4 group-hover:bg-blue-600 group-hover:text-white transition">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </div>
                                <h3 class="text-lg font-bold text-slate-600">Total Tamu Hari Ini</h3>
                            </div>
                            
                            <div class="relative z-10">
                                <span class="text-6xl font-bold text-slate-800 tracking-tighter">{{ $tamuCount }}</span>
                                <span class="text-sm text-slate-400 font-medium ml-2">Orang</span>
                            </div>
                            
                            <div class="absolute bottom-6 right-8 opacity-0 group-hover:opacity-100 transition transform translate-x-4 group-hover:translate-x-0">
                                <span class="text-blue-600 font-bold text-sm flex items-center gap-1">
                                    Lihat Detail <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </span>
                            </div>
                        </a>

                        <a href="{{ route('absen.rekap') }}" class="group relative bg-white rounded-xl p-8 shadow-xl hover:shadow-2xl transition duration-300 border border-slate-100 overflow-hidden flex flex-col justify-between h-64">
                             <div class="absolute right-0 bottom-0 opacity-5 transform translate-y-4 translate-x-4 group-hover:scale-110 transition duration-500">
                                <svg class="w-40 h-40 text-purple-900" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                            </div>

                            <div class="relative z-10">
                                <div class="w-12 h-12 bg-purple-50 rounded-lg flex items-center justify-center text-purple-600 mb-4 group-hover:bg-purple-600 group-hover:text-white transition">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                </div>
                                <h3 class="text-lg font-bold text-slate-600">Riwayat Kehadiran</h3>
                            </div>

                            <div class="relative z-10">
                                <p class="text-slate-500 text-sm leading-relaxed mb-2">
                                    Lihat histori absensi Anda selama bulan ini. Cek keterlambatan dan lokasi absen.
                                </p>
                            </div>

                            <div class="relative z-10 mt-auto">
                                <span class="inline-flex items-center justify-center px-4 py-2 bg-purple-50 text-purple-700 font-bold text-sm rounded-xl group-hover:bg-purple-600 group-hover:text-white transition">
                                    Buka Laporan
                                </span>
                            </div>
                        </a>

                    </div>
                    
                    <div class="mt-6 bg-blue-900 rounded-xl p-8 text-white relative overflow-hidden shadow-xl">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-16 -mt-16 blur-3xl"></div>
                        <div class="relative z-10 flex items-start gap-4">
                            <div class="p-3 bg-white/10 rounded-xl backdrop-blur-sm">
                                <svg class="w-8 h-8 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold mb-1">Info Sistem Absensi</h4>
                                <p class="text-blue-200 text-sm leading-relaxed">
                                    Pastikan Anda berada dalam radius <strong>200 meter</strong> dari titik kantor saat melakukan absensi. 
                                    Jika tombol absen tidak aktif, coba tekan tombol <strong>Refresh Lokasi</strong> atau pindah ke area terbuka.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endif
    </div>
</div>

<script>
    // 1. CLOCK
    setInterval(() => {
        const now = new Date();
        document.getElementById('digital-clock').innerText = now.toLocaleTimeString('id-ID', { hour12: false, hour: '2-digit', minute: '2-digit' });
    }, 1000);

    // 2. CONFIG
    const officeLocations = @json($officeLocations ?? []);
    const statusEl = document.getElementById('location-status');
    const btnAbsen = document.getElementById('btn-absen');
    const inputLat = document.getElementById('input-lat');
    const inputLng = document.getElementById('input-lng');

    // 3. MAP SETUP
    var map = L.map('map', {zoomControl: false}).setView([-8.583271, 116.108032], 16); 
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '' }).addTo(map);

    // Zona Kantor
    officeLocations.forEach(loc => {
        L.circle([loc.lat, loc.lng], {
            color: 'transparent',
            fillColor: '#22c55e',
            fillOpacity: 0.2,
            radius: loc.radius
        }).addTo(map);
    });

    var userMarker = null;

    // RUMUS JARAK
    function getDistance(lat1, lon1, lat2, lon2) {
        const R = 6371e3; 
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;
        const a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * Math.sin(dLon/2) * Math.sin(dLon/2);
        return R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    }

    // FUNGSI LOCK LOCATION (SNAPSHOT)
    function lockLocation() {
        statusEl.innerHTML = `
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 flex items-center justify-center gap-3">
                <svg class="w-5 h-5 text-blue-600 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                <span class="text-sm font-bold text-blue-700">Mencari Koordinat GPS...</span>
            </div>
        `;
        
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((pos) => {
                const userLat = pos.coords.latitude;
                const userLng = pos.coords.longitude;
                const accuracy = pos.coords.accuracy;

                if (userMarker) map.removeLayer(userMarker);
                
                // Custom Icon Marker
                var customIcon = L.divIcon({
                    className: 'custom-div-icon',
                    html: "<div style='background-color:#3b82f6; width: 12px; height: 12px; border-radius: 50%; border: 2px solid white; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.3);'></div>",
                    iconSize: [20, 20],
                    iconAnchor: [10, 10]
                });

                userMarker = L.marker([userLat, userLng], {icon: customIcon}).addTo(map);
                map.setView([userLat, userLng], 17);

                let closestDist = 9999999;
                let closestLocName = '';
                let isValidLocation = false;

                officeLocations.forEach(loc => {
                    const dist = getDistance(userLat, userLng, loc.lat, loc.lng);
                    if (dist < closestDist) {
                        closestDist = dist;
                        closestLocName = loc.name;
                    }
                    if (dist <= loc.radius) isValidLocation = true;
                });

                if(inputLat) inputLat.value = userLat;
                if(inputLng) inputLng.value = userLng;

                const refreshBtn = `<button onclick="lockLocation()" class="mt-2 text-xs bg-white hover:bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-lg text-slate-600 font-bold transition shadow-sm">🔄 Refresh GPS</button>`;

                if (isValidLocation) {
                    statusEl.innerHTML = `
                        <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-center">
                            <div class="flex items-center justify-center gap-2 mb-1">
                                <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                <span class="text-sm font-bold text-green-700">LOKASI VALID</span>
                            </div>
                            <p class="text-xs text-green-600 mb-2">Terdeteksi di area: ${closestLocName}</p>
                            ${refreshBtn}
                        </div>
                    `;
                    if(btnAbsen) {
                        btnAbsen.disabled = false;
                        btnAbsen.className = "w-full py-4 rounded-xl font-bold text-white shadow-lg shadow-blue-500/30 transition-all transform active:scale-95 flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700";
                    }
                } else {
                    statusEl.innerHTML = `
                        <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-center">
                            <div class="flex items-center justify-center gap-2 mb-1">
                                <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                <span class="text-sm font-bold text-red-700">LOKASI DI LUAR JANGKAUAN</span>
                            </div>
                            <p class="text-xs text-red-600 mb-2">Jarak: ${Math.round(closestDist)}m. Akurasi HP: ${Math.round(accuracy)}m</p>
                            ${refreshBtn}
                        </div>
                    `;
                    if(btnAbsen) {
                        btnAbsen.disabled = true;
                        btnAbsen.className = "w-full py-4 rounded-xl font-bold text-white shadow-none transition-all flex items-center justify-center gap-2 bg-slate-300 cursor-not-allowed";
                    }
                }

            }, (err) => {
                statusEl.innerHTML = `<div class="bg-red-50 p-4 rounded-xl text-center text-red-600 text-sm font-bold">Gagal mendeteksi lokasi. <button onclick="lockLocation()" class="underline">Coba Lagi</button></div>`;
            }, { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 });
        } else {
            statusEl.innerHTML = "Browser tidak support GPS.";
        }
    }

    lockLocation();
</script>

<style>
    .animate-fade-in-down { animation: fadeInDown 0.5s ease-out; }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection