<div class="overflow-x-auto max-h-[500px] overflow-y-auto">
    <table class="w-full text-left relative border-collapse">
        <thead class="bg-slate-50 text-gray-900 font-semibold text-sm tracking-wider sticky top-0 z-10 shadow-sm">
            <tr>
                <th class="px-6 py-4 border-b border-slate-200">Nama Pengunjung</th>
                <th class="px-6 py-4 border-b border-slate-200">Asal Instansi</th>
                <th class="px-6 py-4 border-b border-slate-200">Keperluan</th>
                <th class="px-6 py-4 border-b border-slate-200 text-right">Waktu Berkunjung</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 bg-white">
            @foreach($recentGuests as $guest)
                <tr class="hover:bg-blue-50/50 transition duration-150 group">
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-700 group-hover:text-blue-700 transition">{{ $guest->nama_tamu }}
                        </div>
                        <div class="text-[10px] text-slate-400 font-medium">{{ $guest->jumlah_personil }} Personil</div>
                    </td>
                    <td class="px-6 py-4">
                        <span
                            class="inline-block bg-slate-100 text-slate-600 text-xs px-2 py-1 rounded border border-slate-200">
                            {{ $guest->asal_instansi }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-slate-500 text-sm italic">
                        "{{ Str::limit($guest->keperluan, 40) }}"
                    </td>

                    <td class="px-6 py-4 text-right">
                        <div class="text-xs font-bold text-slate-600">{{ $guest->created_at->format('d M Y') }}</div>
                        <div class="text-[10px] text-slate-400 font-mono">{{ $guest->created_at->diffForHumans() }}</div>
                    </td>
                </tr>
            @endforeach

            @if($recentGuests->isEmpty())
                <tr>
                    <td colspan="4" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="bg-slate-50 p-4 rounded-full mb-3">
                                <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <p class="text-slate-500 font-bold">Data tidak ditemukan.</p>
                            <p class="text-slate-400 text-sm">Coba kata kunci lain.</p>
                        </div>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<div class="px-6 py-3 bg-slate-50 border-t border-slate-200 text-xs text-slate-500 flex justify-between items-center">
    <span>Menampilkan <strong>{{ $recentGuests->count() }}</strong> dari <strong>{{ $recentGuests->total() }}</strong>
        data</span>
    <div>
        {{ $recentGuests->fragment('tabel-kunjungan')->links('pagination::tailwind') }}
    </div>
</div>