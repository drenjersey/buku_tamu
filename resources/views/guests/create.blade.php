@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Buku Tamu Digital
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Silakan isi form kunjungan di bawah ini
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-xl">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <form class="space-y-6" action="{{ route('guest.store') }}" method="POST">
                @csrf <div>
                    <label for="tanggal_kunjungan" class="block text-sm font-medium text-gray-700">Tanggal Kunjungan</label>
                    <div class="mt-1">
                        <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan" required value="{{ date('Y-m-d') }}"
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                </div>

                <div>
                    <label for="nama_tamu" class="block text-sm font-medium text-gray-700">Nama Lengkap (Perwakilan)</label>
                    <div class="mt-1">
                        <input type="text" name="nama_tamu" id="nama_tamu" required placeholder="Contoh: Budi Santoso"
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                </div>

                <div>
                    <label for="asal_instansi" class="block text-sm font-medium text-gray-700">Asal Instansi / Kunjungan</label>
                    <div class="mt-1">
                        <input type="text" name="asal_instansi" id="asal_instansi" required placeholder="Contoh: Dinas Kominfo Kota Mataram"
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                </div>

                <div>
                    <label for="nomor_hp atau whatsapp" class="block text-sm font-medium text-gray-700">Nomor HP atau Whatsapp</label>
                    <div class="mt-1">
                        <input type="text" name="nomor_hp" id="nomor_hp" required placeholder="Contoh: 081234567890"
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="jumlah_personil" class="block text-sm font-medium text-gray-700">Jumlah Personil</label>
                        <div class="mt-1">
                            <input type="number" name="jumlah_personil" id="jumlah_personil" required min="1" value="1"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wide">Bertemu Siapa? <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select id="select_penerima" name="penerima_kunjungan" onchange="toggleLainnya(this)" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition outline-none text-sm font-medium appearance-none">
                                <option value="" disabled selected>-- Pilih Penerima --</option>
                                <option value="Kepala Dinas">Kepala Dinas</option>
                                <option value="Sekretaris Dinas">Sekretaris Dinas</option>
                                <option value="Kabid IKP">Kabid IKP</option>
                                <option value="Kabid e-Government">Kabid e-Government</option>
                                <option value="Kabid Statistik">Kabid Statistik</option>
                                <option value="Kabid Persandian Keamanan Informasi">Kabid Persandian Keamanan Informasi</option>
                                <option value="Staf Teknis">Staf Teknis</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>

                        <div id="input_lainnya_div" class="hidden mt-3 animate-fade-in-down">
                            <label class="block text-[10px] font-bold text-slate-400 mb-1 ml-1">Ketik Jabatan/Nama Tujuan:</label>
                            <input type="text" id="input_lainnya" placeholder="Contoh: Staff Keuangan / Pak Budi" class="w-full px-4 py-3 bg-white border border-blue-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm font-medium shadow-sm">
                        </div>
                    </div>

                    <script>
                        function toggleLainnya(selectElement) {
                            var inputDiv = document.getElementById('input_lainnya_div');
                            var inputField = document.getElementById('input_lainnya');

                            if (selectElement.value === 'Lainnya') {
                                // A. Jika pilih 'Lainnya':
                                // 1. Munculkan kotak input
                                inputDiv.classList.remove('hidden');
                                
                                // 2. MATIKAN select agar tidak terkirim datanya
                                selectElement.removeAttribute('name'); 
                                
                                // 3. NYALAKAN input manual agar dia yang terkirim sebagai 'penerima_kunjungan'
                                inputField.setAttribute('name', 'penerima_kunjungan');
                                inputField.setAttribute('required', true);
                                inputField.focus(); // Otomatis kursor kesitu
                            } else {
                                // B. Jika pilih pejabat biasa:
                                // 1. Sembunyikan kotak input
                                inputDiv.classList.add('hidden');
                                
                                // 2. NYALAKAN select kembali
                                selectElement.setAttribute('name', 'penerima_kunjungan');
                                
                                // 3. MATIKAN input manual
                                inputField.removeAttribute('name');
                                inputField.removeAttribute('required');
                                inputField.value = ''; // Kosongkan isinya
                            }
                        }
                    </script>
                </div>

                <div>
                    <label for="keperluan" class="block text-sm font-medium text-gray-700">Keperluan Kunjungan</label>
                    <div class="mt-1">
                        <textarea id="keperluan" name="keperluan" rows="3" required placeholder="Jelaskan tujuan kunjungan secara singkat..."
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-900 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                        SIMPAN DATA KUNJUNGAN
                    </button>
                </div>
            </form>
            
            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-blue-900 font-medium">
                    &larr; Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>
</div>
@endsection