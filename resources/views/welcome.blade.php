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
                <!-- Yellow decorative circle -->
                <div
                    class="absolute w-[280px] h-[280px] md:w-[400px] md:h-[400px] bg-yellow-400 rounded-full opacity-60 -z-10 translate-x-6 translate-y-6 md:translate-x-10 md:translate-y-10">
                </div>

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

    <!-- Extra Quick Links Section (Contoh Tambahan) -->
    <div class="bg-white py-16">
        <div class="container mx-auto px-6 md:px-12">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div
                    class="p-6 rounded-2xl bg-blue-50 hover:bg-blue-100 transition cursor-pointer text-center space-y-3 group">
                    <div
                        class="w-16 h-16 bg-blue-900 rounded-2xl mx-auto flex items-center justify-center text-white group-hover:scale-110 transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-blue-900">Portal Berita</h4>
                </div>
                <div
                    class="p-6 rounded-2xl bg-slate-50 hover:bg-slate-100 transition cursor-pointer text-center space-y-3 group">
                    <div
                        class="w-16 h-16 bg-slate-800 rounded-2xl mx-auto flex items-center justify-center text-white group-hover:scale-110 transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-slate-800">Dokumen Publik</h4>
                </div>
                <div
                    class="p-6 rounded-2xl bg-yellow-50 hover:bg-yellow-100 transition cursor-pointer text-center space-y-3 group">
                    <div
                        class="w-16 h-16 bg-yellow-600 rounded-2xl mx-auto flex items-center justify-center text-white group-hover:scale-110 transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-yellow-700">Galeri Kota</h4>
                </div>
                <div
                    class="p-6 rounded-2xl bg-green-50 hover:bg-green-100 transition cursor-pointer text-center space-y-3 group">
                    <div
                        class="w-16 h-16 bg-green-700 rounded-2xl mx-auto flex items-center justify-center text-white group-hover:scale-110 transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-green-800">Layanan IPKD</h4>
                </div>
            </div>
        </div>
    </div>
@endsection