@extends('layouts.app')

@section('content')
    <div class="relative min-h-screen bg-slate-50 overflow-hidden">
        <div class="absolute inset-0 bg-blue-50/50 -z-10"></div>
        <div class="absolute top-0 right-0 w-1/3 h-1/3 bg-blue-100/30 rounded-full blur-3xl -mr-20 -mt-20"></div>
        <div class="absolute bottom-0 left-0 w-1/4 h-1/4 bg-yellow-100/20 rounded-full blur-3xl -ml-20 -mb-20"></div>

        <div class="container mx-auto px-4 md:px-6 py-12 relative z-10">
            <div class="mb-12">
                <h1 class="text-3xl md:text-4xl font-extrabold text-blue-900 mb-2">Rekap Kunjungan</h1>
                <p class="text-slate-500 font-medium">Laporan data tamu Pemerintah Kota Mataram</p>
                <div class="h-1 w-20 bg-yellow-500 mt-4 rounded-full"></div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-xl border border-blue-50 mb-8">
                <form action="{{ route('guest.rekap') }}" method="GET" class="flex flex-col md:flex-row flex-wrap items-end gap-4 md:gap-6">
                    
                    <div class="space-y-2 w-full md:w-auto">
                        <label class="text-sm font-bold text-slate-600 block">Dari Tanggal</label>
                        <input type="date" name="start_date" value="{{ $startDate }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none text-slate-700">
                    </div>

                    <div class="space-y-2 w-full md:w-auto">
                        <label class="text-sm font-bold text-slate-600 block">Sampai Tanggal</label>
                        <input type="date" name="end_date" value="{{ $endDate }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none text-slate-700">
                    </div>
                    
                    <div class="space-y-2 flex-grow w-full md:w-auto">
                        <label class="text-sm font-bold text-slate-600 block">Cari Nama/Instansi</label>
                        <input type="text" name="search" value="{{ $search }}" placeholder="Ketik kata kunci..."
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none text-slate-700">
                    </div>

                    <div class="flex gap-3 w-full md:w-auto">
                        <button type="submit" class="flex-1 md:flex-none bg-blue-900 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-800 transition shadow-lg shadow-blue-200 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            Filter
                        </button>

                        <button type="submit" formaction="{{ route('guest.export') }}" class="flex-1 md:flex-none bg-green-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-green-700 transition shadow-lg shadow-green-200 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                            CSV
                        </button>

                        <a href="{{ route('guest.rekap') }}" class="flex-1 md:flex-none bg-slate-100 text-slate-600 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition border border-slate-200 text-center">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-xl shadow-2xl border border-blue-50 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap"> 
                        <thead class="bg-blue-900 text-white">
                            <tr>
                                <th class="px-6 py-5 text-sm font-bold uppercase tracking-wider border-r border-blue-700">Tanggal</th>
                                <th class="px-6 py-5 text-sm font-bold uppercase tracking-wider border-r border-blue-700">Nama Tamu</th>
                                <th class="px-6 py-5 text-sm font-bold uppercase tracking-wider border-r border-blue-700">Instansi</th>
                                <th class="px-6 py-5 text-sm font-bold uppercase tracking-wider border-r border-blue-700">Kontak</th>
                                <th class="px-6 py-5 text-sm font-bold uppercase tracking-wider border-r border-blue-700 text-center">Personil</th>
                                <th class="px-6 py-5 text-sm font-bold uppercase tracking-wider border-r border-blue-700">Keperluan</th>
                                <th class="px-6 py-5 text-sm font-bold uppercase tracking-wider border-r border-blue-700">Penerima</th>
                                <th class="px-6 py-5 text-sm font-bold uppercase tracking-wider text-center">Foto</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-blue-50">
                            @forelse($guests as $guest)
                                <tr class="hover:bg-blue-50/50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-blue-900 border-r border-slate-200 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($guest->tanggal_kunjungan)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-slate-700 border-r border-slate-200">
                                        {{ $guest->nama_tamu }}
                                    </td>
                                    <td class="px-6 py-4 border-r border-slate-200">
                                        <span class="inline-block bg-blue-50 text-gray-700 px-3 py-2 rounded-lg text-xs font-bold ring-1 ring-blue-100 whitespace-normal max-w-[180px] leading-tight">
                                            {{ $guest->asal_instansi }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-900 text-xs font-mono border-r border-slate-200">
                                        {{ $guest->kontak ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-600 text-center border-r border-slate-200">
                                        <div class="inline-flex items-center gap-1 bg-yellow-100 text-yellow-800 px-2 py-1 rounded-md text-xs font-bold">
                                            {{ $guest->jumlah_personil }} Org
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600 italic border-r border-slate-200 text-sm max-w-[200px] truncate" title="{{ $guest->keperluan }}">
                                        "{{ $guest->keperluan }}"
                                    </td>
                                    <td class="px-6 py-4 border-r border-slate-200">
                                        <div class="flex items-center gap-2">
                                            <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                            <span class="font-medium text-slate-700 text-sm">{{ $guest->penerima_kunjungan }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @php
                                            $photos = [];
                                            if ($guest->foto_path) {
                                                $decoded = json_decode($guest->foto_path);
                                                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                                    $photos = $decoded;
                                                } else {
                                                    $photos = [$guest->foto_path]; // Handle legacy single path
                                                }
                                            }
                                        @endphp

                                        @if(count($photos) > 0)
                                            <div class="relative group cursor-zoom-in inline-block" 
                                                 onclick="openModal(@js($photos))">
                                                <img src="{{ asset('storage/' . $photos[0]) }}" 
                                                     class="h-10 w-10 md:h-12 md:w-12 object-cover rounded-lg border border-slate-200 shadow-sm transition transform group-hover:scale-105" 
                                                     alt="Foto">
                                                
                                                @if(count($photos) > 1)
                                                    <div class="absolute -top-2 -right-2 bg-blue-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow-md border border-white">
                                                        +{{ count($photos) - 1 }}
                                                    </div>
                                                @endif
                                                
                                                <div class="absolute inset-0 bg-black/30 rounded-lg flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-200">
                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m4-3H6"></path></svg>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-xs text-slate-300 italic">No Image</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="bg-slate-50 p-6 rounded-full mb-4">
                                                <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                            </div>
                                            <p class="text-slate-400 font-medium text-lg">Tidak ada data kunjungan ditemukan.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-8 py-6 bg-slate-50 border-t border-blue-50 flex flex-col md:flex-row justify-between items-center gap-4">
                    <span class="text-sm text-slate-500">
                        Menampilkan <strong>{{ $guests->count() }}</strong> dari <strong>{{ $guests->total() }}</strong> data
                    </span>
                    <div>
                        {{ $guests->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="imageModal" class="fixed inset-0 z-[100] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black/95 backdrop-blur-sm transition-opacity opacity-0 enter:opacity-100 duration-300 ease-out" 
             id="modalBackdrop" 
             onclick="closeModal()">
        </div>

        <button type="button" 
                class="fixed top-6 right-6 z-[120] text-white/80 hover:text-white bg-white/10 hover:bg-red-600 rounded-full p-3 transition duration-200 backdrop-blur-md border border-white/20 shadow-xl group" 
                onclick="closeModal()">
            <svg class="w-8 h-8 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <div class="fixed inset-0 z-[110] overflow-y-auto pointer-events-none"> 
            <div class="flex min-h-full items-center justify-center p-4 text-center">
                <div class="relative transform overflow-hidden rounded-2xl text-left shadow-2xl transition-all pointer-events-auto max-w-5xl w-full max-h-[90vh] flex flex-col bg-transparent" 
                     onclick="event.stopPropagation()"> 
                    
                    <div id="modalContent" class="overflow-y-auto p-4 flex flex-col gap-4 items-center">
                        <!-- Images will be injected here -->
                    </div>
                    
                    <div class="mt-4 text-center pb-4">
                        <span class="inline-block bg-white/10 text-white/70 text-xs px-4 py-2 rounded-full backdrop-blur-md border border-white/10">
                            Tekan tombol <b>X</b> atau klik area gelap untuk menutup
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('imageModal');
        const backdrop = document.getElementById('modalBackdrop');
        const modalContent = document.getElementById('modalContent');

        function openModal(photos) {
            // Ensure photos is an array
            const photoArray = Array.isArray(photos) ? photos : [photos];
            
            // Clear previous content
            modalContent.innerHTML = '';
            
            // Generate images with download buttons
            photoArray.forEach((path, index) => {
                const wrapper = document.createElement('div');
                wrapper.className = "relative group w-full max-w-3xl mb-4";
                
                const img = document.createElement('img');
                const fullPath = "{{ asset('storage') }}/" + path;
                img.src = fullPath;
                img.className = "w-full h-auto object-contain bg-black/50 rounded-2xl border-4 border-white/10 shadow-lg";
                
                const downloadBtn = document.createElement('a');
                downloadBtn.href = fullPath;
                downloadBtn.download = `foto-kunjungan-${index + 1}.jpg`;
                downloadBtn.className = "absolute bottom-4 right-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl font-bold flex items-center gap-2 shadow-xl transition-all opacity-0 group-hover:opacity-100 backdrop-blur-md border border-white/20";
                downloadBtn.innerHTML = `
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Download
                `;

                wrapper.appendChild(img);
                wrapper.appendChild(downloadBtn);
                modalContent.appendChild(wrapper);
            });

            // Add "Download All" button at the bottom if multiple photos
            if (photoArray.length > 1) {
                const downloadAllBtn = document.createElement('button');
                downloadAllBtn.className = "mt-6 bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-2xl font-black flex items-center gap-3 shadow-2xl transition-all transform hover:scale-105 active:scale-95 border-2 border-white/20 mb-8";
                downloadAllBtn.innerHTML = `
                    UNDUH SEMUA FOTO (${photoArray.length})
                `;
                downloadAllBtn.onclick = function() { downloadAll(photoArray, this); };
                modalContent.appendChild(downloadAllBtn);
            }

            modal.classList.remove('hidden');
            setTimeout(() => { backdrop.classList.remove('opacity-0'); }, 10);
            document.body.style.overflow = 'hidden';
        }

        async function downloadAll(photos, btn) {
            const originalText = btn.innerText;
            btn.disabled = true;
            btn.classList.add('opacity-50', 'cursor-not-allowed');

            for (let i = 0; i < photos.length; i++) {
                btn.innerText = `MENGUNDUH (${i + 1}/${photos.length})...`;
                
                const link = document.createElement('a');
                link.href = "{{ asset('storage') }}/" + photos[i];
                link.download = `foto-kunjungan-${i + 1}.jpg`;
                link.style.display = 'none';
                document.body.appendChild(link);
                link.click();
                
                await new Promise(resolve => setTimeout(resolve, 800));
                document.body.removeChild(link);
            }

            btn.innerText = "SELESAI!";
            setTimeout(() => {
                btn.innerText = originalText;
                btn.disabled = false;
                btn.classList.remove('opacity-50', 'cursor-not-allowed');
            }, 2000);
        }

        function closeModal() {
            backdrop.classList.add('opacity-0');
            setTimeout(() => { 
                modal.classList.add('hidden'); 
                modalContent.innerHTML = ''; 
            }, 300);
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape" && !modal.classList.contains('hidden')) { closeModal(); }
        });
    </script>
@endsection