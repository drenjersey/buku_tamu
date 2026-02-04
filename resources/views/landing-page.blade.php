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

        <div class="container mx-auto px-4 flex justify-center items-center relative z-10">
            <div class="bg-white p-6 md:p-10 rounded-xl shadow-2xl border border-blue-100 w-full max-w-xl">
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
                            <label class="block text-xs font-bold text-slate-600 mb-2 tracking-wide">Jumlah Personil <span
                                    class="text-red-500">*</span></label>
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
                        <input type="text" name="asal_instansi" placeholder="Contoh: Dinas Kominfo Lombok Barat" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition outline-none text-sm font-medium">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-2 tracking-wide">Nomor HP / Email <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="kontak" placeholder="Contoh: 081234567890 / email@gmail.com" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition outline-none text-sm font-medium">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-2 tracking-wide">Bertemu Siapa? <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <select id="select_penerima" name="penerima_kunjungan" onchange="toggleLainnya(this)" required
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
                                class="text-red-500">*</span></label>
                        <div class="flex flex-col gap-3">
                            <input type="file" id="input_foto_file" name="foto" accept="image/*" class="hidden"
                                onchange="previewFile()">
                            <div
                                class="border-2 border-dashed border-slate-300 rounded-xl p-4 bg-slate-50 text-center relative group min-h-[150px] flex flex-col items-center justify-center">
                                <img id="preview_image"
                                    class="hidden max-h-48 w-full rounded-lg shadow-md mb-3 object-cover">
                                <div id="placeholder_text" class="text-slate-500">
                                    <svg class="mx-auto h-10 w-10 mb-2 text-slate-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="text-sm font-medium">Belum ada foto</span>
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

    <div class="bg-blue-50 py-16">
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

            <div class="bg-white rounded-2xl shadow-xl border border-blue-100 overflow-hidden" id="tabel-kunjungan">

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
            const pieData = @json($pieData);
            const monthlyData = @json($monthlyData);

            const ctxPie = document.getElementById('pieChart').getContext('2d');
            new Chart(ctxPie, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(pieData),
                    datasets: [{
                        data: Object.values(pieData),
                        backgroundColor: ['#fbbf24', '#60a5fa', '#818cf8', '#34d399', '#f472b6', '#a78bfa', '#cbd5e1'],
                        borderWidth: 0, hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { position: 'right', labels: { boxWidth: 12 } } }, cutout: '60%'
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
        $(document).ready(function () {
            function fetch_data() {
                let query = $('#live_search').val();
                let bulan = $('#filter_bulan').val();
                let tahun = $('#filter_tahun').val();

                $('#loading-indicator').removeClass('hidden');

                $.ajax({
                    url: "{{ route('home') }}",
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
                const file = new File([blob], "kamera_capture_" + Date.now() + ".jpg", { type: "image/jpeg" });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                document.getElementById('input_foto_file').files = dataTransfer.files;
                previewFile();
                closeCameraModal();
            }, 'image/jpeg', 0.9);
        }

        function previewFile() {
            const input = document.getElementById('input_foto_file');
            const preview = document.getElementById('preview_image');
            const placeholder = document.getElementById('placeholder_text');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
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