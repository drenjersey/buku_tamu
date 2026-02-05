@extends('layouts.app')

@section('content')
    <div class="relative min-h-screen bg-slate-50 overflow-hidden">
        <div class="absolute inset-0 bg-blue-50/50 -z-10"></div>
        <div class="absolute top-0 right-0 w-1/3 h-1/3 bg-blue-100/30 rounded-full blur-3xl -mr-20 -mt-20"></div>
        <div class="absolute bottom-0 left-0 w-1/4 h-1/4 bg-purple-100/20 rounded-full blur-3xl -ml-20 -mb-20"></div>

        <div class="container mx-auto px-6 py-12 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-blue-900 mb-2">Laporan Absensi Petugas</h1>
                    <p class="text-slate-500 font-medium">Rekapitulasi kehadiran & lokasi seluruh staf.</p>
                    <div class="h-1 w-20 bg-purple-500 mt-4 rounded-full"></div>
                </div>
                <a href="{{ route('dashboard') }}"
                    class="px-6 py-3 bg-white text-slate-600 rounded-xl font-bold hover:bg-slate-50 transition border border-slate-200 shadow-sm flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-xl border border-blue-50 mb-8 animate-fade-in-down">
                <form action="{{ route('absen.rekap') }}" method="GET" class="flex flex-wrap items-end gap-3">

                    <div class="w-full md:w-48">
                        <label class="text-[10px] font-black text-slate-400 mb-2 block uppercase tracking-[0.1em]">Pilih
                            Petugas</label>
                        <select name="user_id"
                            class="w-full px-4 py-2.5 border border-slate-200 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-slate-700 font-semibold cursor-pointer shadow-sm">
                            <option value="">-- Semua --</option>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>
                                    {{ $u->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full md:w-56">
                        <label class="text-[10px] font-black text-slate-400 mb-2 block uppercase tracking-[0.1em]">Cari Nama
                            Petugas</label>
                        <input type="text" name="search" value="{{ $search ?? request('search') }}"
                            placeholder="Ketik nama..."
                            class="w-full px-4 py-2.5 border border-slate-200 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-slate-700 font-medium shadow-sm">
                    </div>

                    <div class="w-full md:w-auto">
                        <label class="text-[10px] font-black text-slate-400 mb-2 block uppercase tracking-[0.1em]">Dari
                            Tanggal</label>
                        <input type="date" name="start_date" value="{{ $startDate ?? request('start_date') }}"
                            class="w-full md:w-auto px-4 py-2.5 border border-slate-200 rounded-xl bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none transition text-slate-700 font-medium shadow-sm">
                    </div>

                    <div class="w-full md:w-auto">
                        <label class="text-[10px] font-black text-slate-400 mb-2 block uppercase tracking-[0.1em]">Sampai
                            Tanggal</label>
                        <input type="date" name="end_date" value="{{ $endDate ?? request('end_date') }}"
                            class="w-full md:w-auto px-4 py-2.5 border border-slate-200 rounded-xl bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none transition text-slate-700 font-medium shadow-sm">
                    </div>

                    <div class="flex flex-wrap items-center gap-2 mt-2 md:mt-0">
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2.5 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200 flex items-center gap-2 group whitespace-nowrap">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                                </path>
                            </svg>
                            Terapkan Filter
                        </button>

                        <button type="submit" formaction="{{ route('absen.export') }}"
                            class="bg-emerald-600 text-white px-6 py-2.5 rounded-xl font-bold hover:bg-emerald-700 transition shadow-lg shadow-emerald-200 flex items-center gap-2 whitespace-nowrap">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Export CSV
                        </button>

                        <a href="{{ route('absen.rekap') }}"
                            class="px-5 py-2.5 bg-slate-50 text-slate-600 rounded-xl font-bold hover:bg-slate-100 transition border border-slate-200 shadow-sm whitespace-nowrap">
                            Reset
                        </a>
                    </div>
                </form>
            </div>



            <div class="bg-white rounded-lg shadow-xl border border-blue-50 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-800 text-white">
                            <tr>
                                <th class="px-6 py-4 border-r border-slate-600 text-sm font-bold uppercase tracking-wider">
                                    Tanggal</th>
                                <th class="px-6 py-4 border-r border-slate-600 text-sm font-bold uppercase tracking-wider">
                                    Nama Petugas</th>
                                <th
                                    class="px-6 py-4 border-r border-slate-600 text-sm font-bold uppercase tracking-wider text-center">
                                    Masuk</th>
                                <th
                                    class="px-6 py-4 border-r border-slate-600 text-sm font-bold uppercase tracking-wider text-center">
                                    Pulang</th>
                                <th
                                    class="px-6 py-4 border-r border-slate-600 text-sm font-bold uppercase tracking-wider text-center">
                                    Lokasi</th>
                                <th class="px-6 py-4 text-sm font-bold uppercase tracking-wider text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($rekap as $row)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-6 py-4 border-r border-slate-100 font-medium text-slate-600">
                                        {{ \Carbon\Carbon::parse($row->date)->format('d M Y') }}
                                    </td>

                                    <td class="px-6 py-4 border-r border-slate-100 font-bold text-blue-900">
                                        {{ $row->name }}
                                    </td>

                                    <td class="px-6 py-4 border-r border-slate-100 text-center">
                                        @if($row->check_in)
                                            <span
                                                class="bg-green-100 text-green-700 px-3 py-1 rounded-lg font-mono text-xs font-bold ring-1 ring-green-200">
                                                {{ \Carbon\Carbon::parse($row->check_in, 'UTC')->setTimezone('Asia/Makassar')->format('H:i') }}
                                            </span>
                                        @else
                                            <span class="text-slate-300">-</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 border-r border-slate-100 text-center">
                                        @if($row->check_out)
                                            <span
                                                class="bg-red-100 text-red-700 px-3 py-1 rounded-lg font-mono text-xs font-bold ring-1 ring-red-200">
                                                {{ \Carbon\Carbon::parse($row->check_out, 'UTC')->setTimezone('Asia/Makassar')->format('H:i') }}
                                            </span>
                                        @else
                                            <span class="text-slate-300">-</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 border-r border-slate-100 text-center">
                                        @if($row->latitude && $row->longitude)
                                            <a href="https://www.google.com/maps/search/?api=1&query={{ $row->latitude }},{{ $row->longitude }}"
                                                target="_blank"
                                                class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-full hover:bg-blue-100 hover:text-blue-800 transition">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                    </path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                Cek Peta
                                            </a>
                                        @else
                                            <span class="text-xs text-slate-400 italic">No GPS</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 ring-1 ring-blue-200">
                                            {{ $row->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="bg-slate-50 p-4 rounded-full mb-3">
                                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                                    </path>
                                                </svg>
                                            </div>
                                            <p class="text-slate-500 font-medium">Belum ada data absensi pada periode ini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div
                    class="px-8 py-6 bg-slate-50 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    <span class="text-sm text-slate-500">
                        Menampilkan <strong>{{ $rekap->count() }}</strong> dari <strong>{{ $rekap->total() }}</strong> data
                    </span>
                    <div>
                        {{ $rekap->appends(request()->query())->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in-down {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-down {
            animation: fade-in-down 0.5s ease-out;
        }
    </style>

@endsection