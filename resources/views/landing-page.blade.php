@extends('layouts.app')

@section('content')
    <div class="relative min-h-[600px] flex items-center overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 bg-soft skew-y-1 origin-top-left -z-10 h-[90%] rounded-br-[100px]"></div>

        <div class="container mx-auto px-6 md:px-12 flex flex-col lg:flex-row items-center justify-between py-12">

            <!-- Left Content: Text & Search -->
            <div class="w-full lg:w-1/2 space-y-8 z-10 text-center lg:text-left">
                <div class="space-y-4">
                    <h2 class="text-5xl md:text-7xl font-extrabold text-blue-900 leading-tight">
                        Mataram,<br>
                        Kota Nyaman,<br>
                        Penuh Toleransi.
                    </h2>
                    <p class="text-3xl md:text-4xl font-bold">
                        <span class="text-blue-900 italic">Mataram Harum</span>
                        <span class="text-slate-300 mx-2">|</span>
                        <span class="text-yellow-500">Harmoni</span>
                    </p>
                    <p class="text-slate-500 font-medium">kami menjawab informasi seputar kota</p>
                </div>

                <!-- Search Bar -->
                <div class="relative max-w-xl group">
                    <div
                        class="flex items-center bg-white rounded-full shadow-lg p-1 border border-slate-100 overflow-hidden focus-within:ring-2 focus-within:ring-blue-500 transition-all">
                        <input type="text" placeholder="Search..."
                            class="w-full py-4 px-6 outline-none text-slate-600 font-medium">
                        <button class="bg-blue-900 text-white p-4 rounded-full hover:bg-blue-800 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Content: Photos -->
            <div class="w-full lg:w-1/2 relative mt-8 lg:mt-0 flex justify-center">

                <div class="relative">
                    <!-- Image Container for Walikota -->
                    <div
                        class="bg-slate-200 w-[300px] h-[380px] md:w-[450px] md:h-[550px] rounded-b-full overflow-hidden flex items-end justify-center shadow-2xl border-b-6 md:border-b-8 border-blue-900">
                        <img src="/assets/img/walikota_wakil.jpeg" alt="Walikota & Wakil Walikota Mataram"
                            class="w-full h-auto object-cover transform scale-110">
                    </div>

                    <!-- Small Floating Branding Logo -->
                    <div
                        class="absolute -bottom-4 -left-4 md:-bottom-8 md:-left-8 bg-white p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl flex items-center justify-center border border-slate-50">
                        <img src="/assets/img/mataram_branding.jpeg" alt="Mataram Branding"
                            class="w-10 h-10 md:w-16 md:h-16">
                    </div>
                </div>
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
                    <div class="text-5xl font-extrabold text-[#fbbf24] mb-1 group-hover:scale-105 transition">
                        {{ number_format($totalGuests) }}</div>
                    <p class="text-sm text-slate-400">Sejak Awal Tercatat</p>
                </div>

                <!-- This Year -->
                <div
                    class="bg-white p-8 rounded-2xl border border-blue-100 shadow-xl group hover:border-blue-300 transition duration-300">
                    <h4 class="text-lg font-medium text-slate-500 mb-2">Total Tahun Ini</h4>
                    <div class="text-5xl font-extrabold text-[#60a5fa] mb-1 group-hover:scale-105 transition">
                        {{ number_format($totalThisYear) }}</div>
                    <p class="text-sm text-slate-400">Tahun {{ date('Y') }}</p>
                </div>

                <!-- This Month -->
                <div
                    class="bg-white p-8 rounded-2xl border border-blue-100 shadow-xl group hover:border-blue-300 transition duration-300">
                    <h4 class="text-lg font-medium text-slate-500 mb-2">Bulan Ini</h4>
                    <div class="text-5xl font-extrabold text-[#34d399] mb-1 group-hover:scale-105 transition">
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