@extends('layouts.app')

@section('content')
    <div class="relative min-h-screen bg-soft overflow-hidden">
        <!-- Decorative Background -->
        <div class="absolute inset-0 bg-blue-50/50 -z-10"></div>
        <div class="absolute top-0 right-0 w-1/3 h-1/3 bg-blue-100/30 rounded-full blur-3xl -mr-20 -mt-20"></div>
        <div class="absolute bottom-0 left-0 w-1/4 h-1/4 bg-yellow-100/20 rounded-full blur-3xl -ml-20 -mb-20"></div>

        <div class="container mx-auto px-6 py-12 relative z-10">
            <!-- Header -->
            <div class="mb-12">
                <h1 class="text-4xl font-extrabold text-blue-900 mb-2">Rekap Kunjungan</h1>
                <p class="text-slate-500 font-medium">Laporan data tamu Pemerintah Kota Mataram</p>
                <div class="h-1 w-20 bg-yellow-500 mt-4 rounded-full"></div>
            </div>

            <!-- Filter Card -->
            <div class="bg-white p-6 rounded-3xl shadow-xl border border-blue-50 mb-8">
                <form action="{{ route('guest.rekap') }}" method="GET" class="flex flex-wrap items-end gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-600 block">Dari Tanggal</label>
                        <input type="date" name="start_date" value="{{ $startDate }}"
                            class="px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none min-w-[200px] text-slate-700">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-600 block">Sampai Tanggal</label>
                        <input type="date" name="end_date" value="{{ $endDate }}"
                            class="px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none min-w-[200px] text-slate-700">
                    </div>
                    <div class="flex gap-3">
                        <button type="submit"
                            class="bg-blue-900 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-800 transition shadow-lg shadow-blue-200 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Filter
                        </button>

                        <button type="submit" formaction="{{ route('guest.export') }}"
                            class="bg-green-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-green-700 transition shadow-lg shadow-green-200 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            CSV
                        </button>

                        <a href="{{ route('guest.rekap') }}"
                            class="bg-slate-100 text-slate-600 px-8 py-3 rounded-xl font-bold hover:bg-slate-200 transition">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Table Card -->
            <div class="bg-white rounded-[2rem] shadow-2xl border border-blue-50 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-blue-900 text-white">
                            <tr>
                                <th class="px-8 py-5 text-sm font-bold uppercase tracking-wider rounded-tl-[2rem]">Tanggal
                                </th>
                                <th class="px-8 py-5 text-sm font-bold uppercase tracking-wider">Nama Tamu</th>
                                <th class="px-8 py-5 text-sm font-bold uppercase tracking-wider">Instansi</th>
                                <th class="px-8 py-5 text-sm font-bold uppercase tracking-wider">Personil</th>
                                <th class="px-8 py-5 text-sm font-bold uppercase tracking-wider">Keperluan</th>
                                <th class="px-8 py-5 text-sm font-bold uppercase tracking-wider rounded-tr-[2rem]">Penerima
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-blue-50">
                            @forelse($guests as $guest)
                                <tr class="hover:bg-blue-50/50 transition-colors">
                                    <td class="px-8 py-5 font-medium text-blue-900">
                                        {{ \Carbon\Carbon::parse($guest->tanggal_kunjungan)->format('d M Y') }}
                                    </td>
                                    <td class="px-8 py-5 font-bold text-slate-700">{{ $guest->nama_tamu }}</td>
                                    <td class="px-8 py-5 text-slate-600">
                                        <span
                                            class="bg-blue-50 text-blue-700 px-3 py-1 rounded-lg text-xs font-bold ring-1 ring-blue-100">
                                            {{ $guest->asal_instansi }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-slate-600">
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="w-8 h-8 rounded-full bg-yellow-100 text-yellow-700 flex items-center justify-center text-xs font-bold">
                                                {{ $guest->jumlah_personil }}
                                            </span>
                                            <span class="text-xs font-medium text-slate-400">Orang</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-slate-600 italic">"{{ $guest->keperluan }}"</td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-2">
                                            <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                            <span class="font-medium text-slate-700">{{ $guest->penerima_kunjungan }}</span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="bg-slate-50 p-6 rounded-full mb-4">
                                                <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                            <p class="text-slate-400 font-medium text-lg">Tidak ada data kunjungan ditemukan.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($guests->hasPages())
                    <div class="px-8 py-6 bg-slate-50 border-t border-blue-50">
                        {{ $guests->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection