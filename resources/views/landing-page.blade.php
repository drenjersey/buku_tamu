@extends('layouts.app')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div
        class="relative min-h-[800px] flex items-center justify-center bg-gradient-to-br from-blue-50 to-white overflow-hidden py-12">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
            <div class="absolute top-[-10%] right-[-5%] w-72 h-72 md:w-96 md:h-96 bg-blue-100/50 rounded-full blur-3xl">
            </div>
            <div class="absolute bottom-[-10%] left-[-5%] w-72 h-72 md:w-96 md:h-96 bg-yellow-100/50 rounded-full blur-3xl">
            </div>
        </div>

        <div class="container mx-auto px-6 lg:px-24 xl:px-32 relative z-10 grid md:grid-cols-2 gap-12 items-start pt-10">

            <div class="text-center md:text-left mb-12 md:mb-0 lg: lg:border-slate-300 md:pr-12 md:border-r">
                <h1 class="text-5xl xl:text-6xl font-extrabold text-blue-900 leading-tight mb-6 drop-shadow-sm">
                    Buku Tamu Command Center <br>
                </h1>
                <h2 class="text-3xl xl:text-4xl font-bold text-blue-900 mb-8 drop-shadow-sm flex items-center gap-2">
                    Mataram Harum <span class="text-yellow-500">|</span>
                    <div class="h-[1.2em] overflow-hidden inline-block align-top text-yellow-500 relative">
                        <div class="animate-slide-vertical">
                            <div class="h-[1.2em] flex items-center">Harmoni</div>
                            <div class="h-[1.2em] flex items-center">Aman</div>
                            <div class="h-[1.2em] flex items-center">Ramah</div>
                            <div class="h-[1.2em] flex items-center">Unggul</div>
                            <div class="h-[1.2em] flex items-center">Mandiri</div>
                            <div class="h-[1.2em] flex items-center">Harmoni</div>
                        </div>
                    </div>
                </h2>
                <style>
                    @keyframes slide-vertical {

                        0%,
                        15% {
                            transform: translateY(0%);
                        }

                        20%,
                        35% {
                            transform: translateY(-16.66%);
                        }

                        40%,
                        55% {
                            transform: translateY(-33.33%);
                        }

                        60%,
                        75% {
                            transform: translateY(-50%);
                        }

                        80%,
                        95% {
                            transform: translateY(-66.66%);
                        }

                        100% {
                            transform: translateY(-83.33%);
                        }
                    }

                    .animate-slide-vertical {
                        animation: slide-vertical 10s cubic-bezier(0.4, 0, 0.2, 1) infinite;
                    }
                </style>
                <div class="h-1.5 w-24 bg-blue-900 mb-6 rounded-full mx-auto md:mx-0"></div>
                <p class="text-xl text-slate-500 font-medium max-w-md mx-auto md:mx-0">
                    Kami menjawab informasi seputar kota dan melayani dengan sepenuh hati.
                </p>
                <div class="mt-10 flex flex-nowrap justify-center md:justify-start items-center gap-4 md:gap-8">
                    <img src="{{ asset('assets/img/logo_mataram.jpeg') }}" alt="Logo Mataram"
                        class="h-24 sm:h-32 md:h-36 lg:h-40 w-auto drop-shadow-xl hover:scale-105 transition duration-300">
                    <div class="h-16 md:h-20 w-[1.5px] bg-slate-300 hidden sm:block rounded-full mx-2"></div>
                    <img src="{{ asset('assets/img/logo_kominfo.png') }}" alt="Logo Kominfo"
                        class="h-24 sm:h-32 md:h-36 lg:h-40 w-auto drop-shadow-xl hover:scale-105 transition duration-300">
                </div>
                <div class="mt-8 hidden md:block">
                    <span
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-900 text-sm font-bold border border-blue-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Terhubung & Melayani
                    </span>
                </div>
            </div>

            <div class="flex justify-center md:justify-end w-full">
                <div class="bg-white p-6 md:p-10 rounded-xl shadow-2xl border border-blue-100 w-full max-w-xl relative">
                    <div class="absolute -top-4 -right-4 w-20 h-20 bg-yellow-400 rounded-full blur-2xl opacity-20 -z-10">
                    </div>
                    <div class="absolute -bottom-4 -left-4 w-20 h-20 bg-blue-600 rounded-full blur-2xl opacity-20 -z-10">
                    </div>
                    <div class="mb-8 text-center">
                        <h2 class="text-2xl md:text-3xl font-extrabold text-blue-900">Isi Buku Tamu</h2>
                        <p class="text-slate-500 text-sm mt-2">Silakan isi form di bawah ini untuk pendataan tamu.</p>
                    </div>

                    @if(session('success'))
                        <div
                            class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('guest.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 tracking-wide">Tanggal<span
                                        class="text-red-500">*</span></label>
                                <input type="date" name="tanggal_kunjungan" value="{{ date('Y-m-d') }}" required
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition outline-none text-sm font-medium">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 tracking-wide">Jumlah Personil
                                    <span class="text-red-500">*</span></label>
                                <input type="number" name="jumlah_personil" value="1" min="1" required
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition outline-none text-sm font-medium">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-600 mb-2 tracking-wide">Nama Lengkap
                                (Perwakilan)<span class="text-red-500">*</span></label>
                            <input type="text" name="nama_tamu" placeholder="Contoh: Budi Santoso" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition outline-none text-sm font-medium">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-600 mb-2 tracking-wide">Asal Instansi<span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="asal_instansi" placeholder="Contoh: Dinas Kominfo Lombok Barat"
                                required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition outline-none text-sm font-medium">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-600 mb-2 tracking-wide">Nomor HP / Email <span
                                    class="text-gray-400 font-normal normal-case">(Opsional)</span></label>
                            <input type="text" name="kontak" placeholder="Contoh: 081234567890 / email@gmail.com"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition outline-none text-sm font-medium">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-600 mb-2 tracking-wide">Bertemu Siapa? <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <select id="select_penerima" name="penerima_kunjungan" onchange="toggleLainnya(this)"
                                    required
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition outline-none text-sm font-medium appearance-none">
                                    <option value="" disabled selected>-- Pilih Penerima --</option>
                                    <option value="Kepala Dinas">Kepala Dinas</option>
                                    <option value="Sekretaris Dinas">Sekretaris Dinas</option>
                                    <option value="Kabid IKP">Kabid IKP</option>
                                    <option value="Kabid e-Government">Kabid e-Government</option>
                                    <option value="Kabid Statistik">Kabid Statistik</option>
                                    <option value="Kabid Persandian Keamanan Informasi">Kabid Persandian Keamanan Informasi
                                    </option>
                                    <option value="Staf Teknis">Staf Teknis</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <div
                                    class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            <div id="input_lainnya_div" class="hidden mt-3 animate-fade-in-down">
                                <label class="block text-[10px] font-bold text-slate-400 mb-1 ml-1">Ketik Jabatan/Nama
                                    Tujuan:</label>
                                <input type="text" id="input_lainnya" placeholder="Contoh: Staff Keuangan / Pak Budi"
                                    class="w-full px-4 py-3 bg-white border border-blue-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm font-medium shadow-sm">
                            </div>
                        </div>

                        <script>
                            function toggleLainnya(selectElement) {
                                var inputDiv = document.getElementById('input_lainnya_div');
                                var inputField = document.getElementById('input_lainnya');
                                if (selectElement.value === 'Lainnya') {
                                    inputDiv.classList.remove('hidden'); selectElement.removeAttribute('name'); inputField.setAttribute('name', 'penerima_kunjungan'); inputField.setAttribute('required', true); inputField.focus();
                                } else {
                                    inputDiv.classList.add('hidden'); selectElement.setAttribute('name', 'penerima_kunjungan'); inputField.removeAttribute('name'); inputField.removeAttribute('required'); inputField.value = '';
                                }
                            }
                        </script>

                        <div>
                            <label class="block text-xs font-bold text-slate-600 mb-2 tracking-wide">Keperluan <span
                                    class="text-gray-400 font-normal normal-case">(Singkat saja)</span> <span
                                    class="text-red-500">*</span></label>
                            <textarea name="keperluan" rows="2" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition outline-none text-sm font-medium"></textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-600 mb-2 tracking-wide">Foto Dokumentasi <span
                                    class="text-gray-400 font-normal normal-case">(Opsional - Maks 10 Foto)</span></label>
                            <div class="flex flex-col gap-3">
                                <input type="file" id="input_foto_file" name="foto[]" accept="image/*" multiple
                                    class="hidden" onchange="previewFile()">
                                <div
                                    class="border-2 border-dashed border-slate-300 rounded-xl p-4 bg-slate-50 text-center relative group min-h-[150px] flex flex-col items-center justify-center">
                                    <div id="preview_container"
                                        class="hidden w-full grid grid-cols-2 md:grid-cols-3 gap-2 mb-3">
                                        <!-- Previews will be inserted here -->
                                    </div>
                                    <div id="placeholder_text" class="text-slate-500">
                                        <svg class="mx-auto h-10 w-10 mb-2 text-slate-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <span class="text-sm font-medium">Belum ada foto</span>
                                        <p class="text-xs text-slate-400 mt-1">Bisa pilih lebih dari satu</p>
                                    </div>
                                    <div class="flex gap-3 mt-2">
                                        <button type="button" onclick="document.getElementById('input_foto_file').click()"
                                            class="bg-white border border-slate-300 text-slate-700 px-4 py-2 rounded-lg text-xs font-bold hover:bg-slate-100 transition flex items-center gap-2">
                                            Upload File
                                        </button>
                                        <button type="button" onclick="openCameraModal()"
                                            class="bg-blue-900 text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-blue-800 transition flex items-center gap-2 shadow-md">
                                            Ambil Foto
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-900 text-white font-bold py-4 rounded-xl hover:bg-blue-800 transition shadow-lg shadow-blue-900/20 transform hover:-translate-y-1 flex justify-center items-center gap-2">
                            <span>SIMPAN DATA KUNJUNGAN</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="statistik" class="bg-blue-50 py-16 scroll-mt-24">
        <div class="container mx-auto px-4 md:px-12">
            <div class="text-center mb-12">
                <h3 class="text-2xl md:text-3xl font-bold text-blue-900">Statistik Kunjungan</h3>
                <p class="text-slate-500 mt-2">Data analitik buku tamu Pemerintah Kota Mataram</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <div class="bg-white p-6 rounded-2xl border border-blue-100 shadow-xl">
                    <h4 class="font-bold text-blue-900 mb-6">Komposisi Instansi Pengunjung</h4>
                    <div class="relative h-64 w-full flex justify-center">
                        <canvas id="pieChart"></canvas>
                    </div>
                    <div id="chart-nav" class="mt-4 flex justify-end items-center gap-3 hidden">
                        <span id="chartPageInfo" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">1 /
                            1</span>
                        <div class="flex gap-1">
                            <button id="prevChart"
                                class="flex items-center justify-center w-8 h-8 bg-white border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-50 transition shadow-sm disabled:opacity-30">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button id="nextChart"
                                class="flex items-center justify-center w-8 h-8 bg-white border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-50 transition shadow-sm disabled:opacity-30">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-blue-100 shadow-xl">
                    <h4 class="font-bold text-blue-900 mb-6">Pengunjung per Bulan ({{ date('Y') }})</h4>
                    <div class="relative h-64 w-full">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div
                    class="bg-white p-8 rounded-2xl border border-blue-100 shadow-xl group hover:border-blue-300 transition duration-300 text-center">
                    <h4 class="text-lg font-medium text-slate-500 mb-2">Total Pengunjung</h4>
                    <div class="text-5xl font-extrabold text-gray-800 mb-1 group-hover:scale-105 transition">
                        {{ number_format($totalGuests) }}
                    </div>
                    <p class="text-sm text-slate-400">Sejak Awal Tercatat</p>
                </div>
                <div
                    class="bg-white p-8 rounded-2xl border border-blue-100 shadow-xl group hover:border-blue-300 transition duration-300 text-center">
                    <h4 class="text-lg font-medium text-slate-500 mb-2">Total Tahun Ini</h4>
                    <div class="text-5xl font-extrabold text-gray-800 mb-1 group-hover:scale-105 transition">
                        {{ number_format($totalThisYear) }}
                    </div>
                    <p class="text-sm text-slate-400">Tahun {{ date('Y') }}</p>
                </div>
                <div
                    class="bg-white p-8 rounded-2xl border border-blue-100 shadow-xl group hover:border-blue-300 transition duration-300 text-center">
                    <h4 class="text-lg font-medium text-slate-500 mb-2">Bulan Ini</h4>
                    <div class="text-5xl font-extrabold text-gray-800 mb-1 group-hover:scale-105 transition">
                        {{ number_format($totalThisMonth) }}
                    </div>
                    <p class="text-sm text-slate-400">Bulan {{ date('F') }}</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl border border-blue-100 overflow-hidden scroll-mt-24"
                id="tabel-kunjungan">

                <div class="p-6 border-b border-blue-50 flex flex-col xl:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-3 w-full xl:w-auto">
                        <h4 class="font-bold text-blue-900 text-lg whitespace-nowrap">Daftar Kunjungan</h4>
                        <span id="loading-indicator" class="hidden text-xs font-bold text-blue-500 animate-pulse">Sedang
                            mencari...</span>
                    </div>

                    <div class="flex flex-col md:flex-row items-center gap-2 w-full xl:w-auto">

                        <div class="relative w-full md:w-64">
                            <input type="text" id="live_search" placeholder="Ketik nama atau instansi..."
                                class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg text-sm bg-slate-50 focus:ring-2 focus:ring-blue-500 outline-none transition"
                                autocomplete="off">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="flex gap-2 w-full md:w-auto">
                            <select id="filter_bulan"
                                class="w-1/2 md:w-auto px-3 py-2 border border-slate-200 rounded-lg text-sm bg-slate-50 focus:ring-2 focus:ring-blue-500 outline-none cursor-pointer">
                                <option value="">- Bulan -</option>
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}">{{ \Carbon\Carbon::create()->month($i)->locale('id')->monthName }}
                                    </option>
                                @endfor
                            </select>

                            <select id="filter_tahun"
                                class="w-1/2 md:w-auto px-3 py-2 border border-slate-200 rounded-lg text-sm bg-slate-50 focus:ring-2 focus:ring-blue-500 outline-none cursor-pointer">
                                <option value="">- Tahun -</option>
                                @for($y = date('Y'); $y >= date('Y') - 2; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>

                        <button onclick="resetFilters()"
                            class="bg-slate-200 hover:bg-slate-300 text-slate-600 px-3 py-2 rounded-lg text-sm font-bold transition border border-slate-300"
                            title="Reset">
                            ↺
                        </button>
                    </div>
                </div>

                <div id="guest-table-container" class="overflow-x-auto">
                    @include('partials.guests-table')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const pieData = <?php echo json_encode($pieData); ?>;
            const monthlyData = <?php echo json_encode($monthlyData); ?>;

            const ctxPie = document.getElementById('pieChart').getContext('2d');
            const allLabels = Object.keys(pieData);
            const allValues = Object.values(pieData);
            const pageSize = 10;
            let currentChartPage = 0;
            const totalChartPages = Math.ceil(allLabels.length / pageSize);

            // Function to generate professional HSL colors dynamically
            const generateColors = (count, offset = 0) => {
                const colors = [];
                const basePalette = [
                    '#3b82f6', '#f59e0b', '#10b981', '#8b5cf6', '#ec4899',
                    '#06b6d4', '#f43f5e', '#84cc16', '#6366f1', '#14b8a6'
                ];

                for (let i = 0; i < count; i++) {
                    const paletteIndex = (i + offset) % basePalette.length;
                    if ((i + offset) < basePalette.length) {
                        colors.push(basePalette[paletteIndex]);
                    } else {
                        const hue = ((i + offset) * 137.5) % 360;
                        colors.push(`hsl(${hue}, 70%, 55%)`);
                    }
                }
                return colors;
            };

            let myPieChart;

            function updateChartPage(page) {
                const start = page * pageSize;
                const end = start + pageSize;
                const pagedLabels = allLabels.slice(start, end);
                const pagedValues = allValues.slice(start, end);
                const pagedColors = generateColors(pagedLabels.length, start);

                if (myPieChart) {
                    myPieChart.data.labels = pagedLabels;
                    myPieChart.data.datasets[0].data = pagedValues;
                    myPieChart.data.datasets[0].backgroundColor = pagedColors;
                    myPieChart.update();
                } else {
                    myPieChart = new Chart(ctxPie, {
                        type: 'doughnut',
                        data: {
                            labels: pagedLabels,
                            datasets: [{
                                data: pagedValues,
                                backgroundColor: pagedColors,
                                borderWidth: 2,
                                borderColor: '#ffffff',
                                hoverOffset: 12
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            layout: { padding: 10 },
                            plugins: {
                                legend: {
                                    position: 'right',
                                    display: true, // Always show legend since we now have pagination
                                    labels: {
                                        usePointStyle: true,
                                        pointStyle: 'circle',
                                        padding: 10,
                                        font: { size: 10, weight: '600' },
                                        boxWidth: 6
                                    }
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(255, 255, 255, 0.95)',
                                    titleColor: '#1e293b',
                                    bodyColor: '#475569',
                                    borderColor: '#e2e8f0',
                                    borderWidth: 1,
                                    padding: 12,
                                    boxPadding: 4,
                                    usePointStyle: true,
                                    callbacks: {
                                        label: function (context) {
                                            const label = context.label || '';
                                            const value = context.raw || 0;
                                            const total = allValues.reduce((a, b) => a + b, 0);
                                            const percentage = ((value / total) * 100).toFixed(1) + '%';
                                            return ` ${label}: ${value} kunjungan (${percentage})`;
                                        }
                                    }
                                }
                            },
                            cutout: '65%'
                        }
                    });
                }

                // Update UI Nav
                const navContainer = document.getElementById('chart-nav');
                if (totalChartPages > 1) {
                    navContainer.classList.remove('hidden');
                    navContainer.classList.add('flex'); // Ensure it's flex
                    document.getElementById('chartPageInfo').innerText = `${page + 1} / ${totalChartPages}`;
                    document.getElementById('prevChart').disabled = (page === 0);
                    document.getElementById('nextChart').disabled = (page === totalChartPages - 1);
                } else {
                    navContainer.classList.add('hidden');
                }
            }

            // Initial render
            updateChartPage(0);

            // Nav Listeners
            document.getElementById('prevChart').addEventListener('click', () => {
                if (currentChartPage > 0) {
                    currentChartPage--;
                    updateChartPage(currentChartPage);
                }
            });

            document.getElementById('nextChart').addEventListener('click', () => {
                if (currentChartPage < totalChartPages - 1) {
                    currentChartPage++;
                    updateChartPage(currentChartPage);
                }
            });

            const ctxBar = document.getElementById('barChart').getContext('2d');
            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: monthlyData.map(data => data.month),
                    datasets: [{
                        label: 'Pengunjung',
                        data: monthlyData.map(data => data.count),
                        backgroundColor: '#60a5fa', borderRadius: 4, barThickness: 'flex', maxBarThickness: 32
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: '#e2e8f0' }, ticks: { stepSize: 1 } },
                        x: { grid: { display: false } }
                    }
                }
            });
        });

        // AJAX LIVE SEARCH SCRIPT
        // AJAX LIVE SEARCH SCRIPT
        function fetch_data(page = 1) {
            let query = $('#live_search').val();
            let bulan = $('#filter_bulan').val();
            let tahun = $('#filter_tahun').val();

            $('#loading-indicator').removeClass('hidden');

            $.ajax({
                url: "{{ route('home') }}?page=" + page,
                method: 'GET',
                data: { search: query, bulan: bulan, tahun: tahun },
                success: function (data) {
                    $('#guest-table-container').html(data);
                    $('#loading-indicator').addClass('hidden');
                }
            });
        }

        // Trigger saat mengetik
        $('#live_search').on('keyup', function () { fetch_data(); });
        // Trigger saat dropdown berubah
        $('#filter_bulan, #filter_tahun').on('change', function () { fetch_data(); });

        // Trigger saat klik pagination
        $(document).on('click', '#guest-table-container nav a, .pagination a', function (event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);

            // Scroll ke tabel
            document.getElementById('tabel-kunjungan').scrollIntoView({ behavior: 'smooth' });
        });

        function resetFilters() {
            $('#live_search').val('');
            $('#filter_bulan').val('');
            $('#filter_tahun').val('');
            $('#live_search').trigger('keyup');
        }

        let videoStream;
        let currentFacingMode = 'user';

        async function openCameraModal() {
            const modal = document.getElementById('cameraModal');
            const video = document.getElementById('videoElement');
            try {
                videoStream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: currentFacingMode } });
                video.srcObject = videoStream;
                modal.classList.remove('hidden');
            } catch (err) { alert("Gagal mengakses kamera: " + err); }
        }

        function closeCameraModal() {
            const modal = document.getElementById('cameraModal');
            if (videoStream) { videoStream.getTracks().forEach(track => track.stop()); }
            modal.classList.add('hidden');
        }

        function switchCamera() {
            closeCameraModal();
            currentFacingMode = (currentFacingMode === 'user') ? 'environment' : 'user';
            setTimeout(openCameraModal, 200);
        }

        let accumulatedFiles = new DataTransfer();

        function takeSnapshot() {
            const video = document.getElementById('videoElement');
            const canvas = document.getElementById('canvasElement');
            const flash = document.getElementById('flashEffect');

            flash.classList.remove('opacity-0');
            setTimeout(() => flash.classList.add('opacity-0'), 100);

            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const context = canvas.getContext('2d');
            if (currentFacingMode === 'user') { context.translate(canvas.width, 0); context.scale(-1, 1); }
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            canvas.toBlob(function (blob) {
                const file = new File([blob], "kamera_" + Date.now() + ".jpg", { type: "image/jpeg" });

                // Add to accumulated files
                accumulatedFiles.items.add(file);

                // Update input files
                document.getElementById('input_foto_file').files = accumulatedFiles.files;

                previewFile();

                // Optional: Don't close modal immediately if they want to take multiple? 
                // For now closing it as expected behavior, user can open again.
                closeCameraModal();
            }, 'image/jpeg', 0.9);
        }

        function previewFile() {
            const input = document.getElementById('input_foto_file');
            const previewContainer = document.getElementById('preview_container');
            const placeholder = document.getElementById('placeholder_text');

            // Sync accumulatedFiles with input if input changed manually (via upload button)
            if (input.files.length > accumulatedFiles.files.length) {
                accumulatedFiles = new DataTransfer();
                Array.from(input.files).forEach(file => accumulatedFiles.items.add(file));
            }

            previewContainer.innerHTML = '';

            if (accumulatedFiles.files && accumulatedFiles.files.length > 0) {
                previewContainer.classList.remove('hidden');
                placeholder.classList.add('hidden');

                Array.from(accumulatedFiles.files).forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const imgDiv = document.createElement('div');
                        imgDiv.className = 'relative group aspect-square';

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'w-full h-full object-cover rounded-lg shadow-sm';

                        const removeBtn = document.createElement('button');
                        removeBtn.type = 'button';
                        removeBtn.className = 'absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition';
                        removeBtn.innerHTML = '<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
                        removeBtn.onclick = function () {
                            removeFile(index);
                        };

                        imgDiv.appendChild(img);
                        imgDiv.appendChild(removeBtn);
                        previewContainer.appendChild(imgDiv);
                    }
                    reader.readAsDataURL(file);
                });
            } else {
                previewContainer.classList.add('hidden');
                placeholder.classList.remove('hidden');
            }
        }

        function removeFile(index) {
            const dt = new DataTransfer();
            const files = accumulatedFiles.files;

            for (let i = 0; i < files.length; i++) {
                if (i !== index) {
                    dt.items.add(files[i]);
                }
            }

            accumulatedFiles = dt;
            document.getElementById('input_foto_file').files = accumulatedFiles.files;
            previewFile();
        }
    </script>

    <div id="cameraModal" class="fixed inset-0 z-50 hidden bg-black/90 flex items-center justify-center">
        <div class="relative w-full max-w-lg bg-black rounded-2xl overflow-hidden shadow-2xl border border-gray-800">
            <div id="flashEffect"
                class="absolute inset-0 bg-white opacity-0 pointer-events-none z-20 transition-opacity duration-100"></div>
            <video id="videoElement" autoplay playsinline class="w-full h-auto bg-black transform scale-x-[-1]"></video>
            <canvas id="canvasElement" class="hidden"></canvas>
            <div class="absolute bottom-6 left-0 right-0 flex justify-center items-center gap-6 z-10">
                <button type="button" onclick="closeCameraModal()"
                    class="bg-gray-600/50 backdrop-blur text-white p-3 rounded-full hover:bg-gray-500 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <button type="button" onclick="takeSnapshot()"
                    class="bg-white p-1 rounded-full border-4 border-gray-300 hover:border-blue-500 transition transform hover:scale-110">
                    <div class="w-14 h-14 bg-white rounded-full border-2 border-black"></div>
                </button>
                <button type="button" onclick="switchCamera()"
                    class="bg-gray-600/50 backdrop-blur text-white p-3 rounded-full hover:bg-gray-500 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="absolute top-4 left-0 right-0 text-center">
                <span class="bg-black/50 text-white text-xs px-3 py-1 rounded-full backdrop-blur">Sesuaikan Wajah dalam
                    Bingkai</span>
            </div>
        </div>
    </div>
@endsection