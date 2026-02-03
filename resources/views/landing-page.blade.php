@extends('layouts.app')

@section('content')
    <div class="relative min-h-[800px] flex items-center justify-center bg-gradient-to-br from-blue-50 to-white overflow-hidden py-12">
        
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
            <div class="absolute top-[-10%] right-[-5%] w-96 h-96 bg-blue-100/50 rounded-full blur-3xl"></div>
            <div class="absolute bottom-[-10%] left-[-5%] w-96 h-96 bg-yellow-100/50 rounded-full blur-3xl"></div>
        </div>

        <div class="container mx-auto px-4 flex justify-center items-center relative z-10">
            
            <div class="bg-white p-8 md:p-10 rounded-3xl shadow-2xl border border-blue-100 w-full max-w-xl">
                
                <div class="mb-8 text-center">
                    <h2 class="text-3xl font-extrabold text-blue-900">Isi Buku Tamu</h2>
                    <p class="text-slate-500 text-sm mt-2">Silakan isi form di bawah ini untuk pendataan tamu.</p>
                </div>

                @if(session('success'))
                    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('guest.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wide">Tanggal <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_kunjungan" value="{{ date('Y-m-d') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition outline-none text-sm font-medium">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wide">Jml Personil <span class="text-red-500">*</span></label>
                            <input type="number" name="jumlah_personil" value="1" min="1" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition outline-none text-sm font-medium">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wide">Nama Lengkap (Perwakilan) <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_tamu" placeholder="Contoh: Budi Santoso" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition outline-none text-sm font-medium">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wide">Asal Instansi <span class="text-red-500">*</span></label>
                        <input type="text" name="asal_instansi" placeholder="Contoh: Dinas Kominfo Lombok Barat" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition outline-none text-sm font-medium">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wide">Bertemu Siapa? <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="penerima_kunjungan" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition outline-none text-sm font-medium appearance-none">
                                <option value="" disabled selected>-- Pilih Penerima --</option>
                                <option value="Kepala Dinas">Kepala Dinas</option>
                                <option value="Sekretaris Dinas">Sekretaris Dinas</option>
                                <option value="Kabid IKP">Kabid IKP</option>
                                <option value="Kabid Aptika">Kabid Aptika</option>
                                <option value="Staf Teknis">Staf Teknis</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wide">Keperluan <span class="text-gray-400 font-normal normal-case">(Singkat saja)</span> <span class="text-red-500">*</span></label>
                        <textarea name="keperluan" rows="2" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition outline-none text-sm font-medium"></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wide">Foto Dokumentasi <span class="text-red-500">*</span></label>
                        <div class="relative border-2 border-dashed border-slate-300 rounded-xl p-4 hover:bg-slate-50 transition text-center group">
                            <input type="file" name="foto" accept="image/*" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <div class="text-slate-500 group-hover:text-blue-600 transition">
                                <svg class="mx-auto h-8 w-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-sm font-medium">Klik untuk upload foto</span>
                                <p class="text-[10px] mt-1 text-slate-400">JPG/PNG, Maks 2MB</p>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-blue-900 text-white font-bold py-4 rounded-xl hover:bg-blue-800 transition shadow-lg shadow-blue-900/20 transform hover:-translate-y-1 flex justify-center items-center gap-2">
                        <span>SIMPAN DATA KUNJUNGAN</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Statistik Dashboard Section -->
    <div class="bg-blue-50 py-16">
        <div class="container mx-auto px-6 md:px-12">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-blue-900">Statistik Kunjungan</h3>
                <p class="text-slate-500 mt-2">Data analitik buku tamu Pemerintah Kota Mataram</p>
            </div>

            <!-- Top Row: Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

                <!-- Pie Chart: Komposisi Instansi -->
                <div class="bg-white p-6 rounded-2xl border border-blue-100 shadow-xl">
                    <h4 class="font-bold text-blue-900 mb-6">Komposisi Instansi Pengunjung</h4>
                    <div class="relative h-64 w-full flex justify-center">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>

                <!-- Bar Chart: Bulanan -->
                <div class="bg-white p-6 rounded-2xl border border-blue-100 shadow-xl">
                    <h4 class="font-bold text-blue-900 mb-6">Pengunjung per Bulan ({{ date('Y') }})</h4>
                    <div class="relative h-64 w-full">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Bottom Row: KPI Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <!-- Total Visitors -->
                <div
                    class="bg-white p-8 rounded-2xl border border-blue-100 shadow-xl group hover:border-blue-300 transition duration-300">
                    <h4 class="text-lg font-medium text-slate-500 mb-2">Total Pengunjung</h4>
                    <div class="text-5xl font-extrabold text-gray-800 mb-1 group-hover:scale-105 transition">
                        {{ number_format($totalGuests) }}</div>
                    <p class="text-sm text-slate-400">Sejak Awal Tercatat</p>
                </div>

                <!-- This Year -->
                <div
                    class="bg-white p-8 rounded-2xl border border-blue-100 shadow-xl group hover:border-blue-300 transition duration-300">
                    <h4 class="text-lg font-medium text-slate-500 mb-2">Total Tahun Ini</h4>
                    <div class="text-5xl font-extrabold text-gray-800 mb-1 group-hover:scale-105 transition">
                        {{ number_format($totalThisYear) }}</div>
                    <p class="text-sm text-slate-400">Tahun {{ date('Y') }}</p>
                </div>

                <!-- This Month -->
                <div
                    class="bg-white p-8 rounded-2xl border border-blue-100 shadow-xl group hover:border-blue-300 transition duration-300">
                    <h4 class="text-lg font-medium text-slate-500 mb-2">Bulan Ini</h4>
                    <div class="text-5xl font-extrabold text-gray-800 mb-1 group-hover:scale-105 transition">
                        {{ number_format($totalThisMonth) }}</div>
                    <p class="text-sm text-slate-400">Bulan {{ date('F') }}</p>
                </div>
            </div>

            <!-- Recent Visitors Table (Light/Blue Mode) -->
            <div class="bg-white rounded-2xl shadow-xl border border-blue-100 overflow-hidden">
                <div class="p-6 border-b border-blue-50 flex justify-between items-center">
                    <h4 class="font-bold text-blue-900 text-lg">Kunjungan Terakhir</h4>
                    <span class="text-xs font-bold bg-blue-100 text-blue-600 px-3 py-1 rounded-full">Realtime</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-blue-50 text-blue-600 font-semibold text-sm uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Nama</th>
                                <th class="px-6 py-4">Instansi/Asal</th>
                                <th class="px-6 py-4">Keperluan</th>
                                <th class="px-6 py-4">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-blue-50">
                            @foreach($recentGuests as $guest)
                                <tr class="hover:bg-blue-50/50 transition duration-200">
                                    <td class="px-6 py-4 font-medium text-slate-700">{{ $guest->nama_tamu }}</td>
                                    <td class="px-6 py-4 text-slate-500">{{ $guest->asal_instansi }}</td>
                                    <td class="px-6 py-4 text-slate-500">{{ $guest->keperluan }}</td>
                                    <td class="px-6 py-4 text-slate-400 text-sm whitespace-nowrap">
                                        {{ $guest->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                            @if($recentGuests->isEmpty())
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-slate-400">Belum ada data pengunjung.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // DATA FROM CONTROLLER
            const pieData = @json($pieData);
            const monthlyData = @json($monthlyData);

            // 1. PIE CHART (Doughnut)
            const ctxPie = document.getElementById('pieChart').getContext('2d');
            new Chart(ctxPie, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(pieData),
                    datasets: [{
                        data: Object.values(pieData),
                        backgroundColor: [
                            '#fbbf24', // yellow
                            '#60a5fa', // blue
                            '#818cf8', // indigo
                            '#34d399', // green
                            '#f472b6', // pink
                            '#a78bfa', // purple
                            '#cbd5e1'  // slate
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                color: '#475569', // slate-600
                                font: { size: 12 },
                                boxWidth: 12
                            }
                        }
                    },
                    cutout: '60%'
                }
            });

            // 2. BAR CHART
            const ctxBar = document.getElementById('barChart').getContext('2d');
            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: monthlyData.map(data => data.month),
                    datasets: [{
                        label: 'Pengunjung',
                        data: monthlyData.map(data => data.count),
                        backgroundColor: '#60a5fa', // blue-400
                        borderRadius: 4,
                        barThickness: 'flex',
                        maxBarThickness: 32
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1e3a8a',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#e2e8f0' }, // slate-200
                            ticks: { color: '#64748b', stepSize: 1, precision: 0 }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#64748b', font: { size: 11 } }
                        }
                    }
                }
            });
        });
    </script>
@endsection