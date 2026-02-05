<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemerintah Kota Mataram - Mataram Harum | Harmoni</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .bg-soft {
            background-color: #F8FAFC;
        }

        /* Animasi Menu Mobile */
        #mobile-menu {
            transition: max-height 0.3s ease-in-out, opacity 0.3s ease-in-out;
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            pointer-events: none;
        }

        #mobile-menu.open {
            max-height: 500px;
            opacity: 1;
            pointer-events: auto;
        }
    </style>
</head>

<body id="top" class="bg-soft text-slate-800 flex flex-col min-h-screen">

    <header
        class="bg-white py-4 px-4 md:px-6 lg:px-12 flex items-center justify-between sticky top-0 z-[1000] shadow-sm transition-all duration-300 pointer-events-auto">

        <div class="flex items-center gap-2 md:gap-4 max-w-[70%]"> <img src="{{ asset('assets/img/logo_kominfo.png') }}"
                alt="Logo Kominfo" class="h-8 md:h-12 w-auto object-contain">

            <div class="h-6 md:h-8 w-px bg-slate-200"></div>

            <img src="{{ asset('assets/img/logo_mataram.jpeg') }}" alt="Logo Mataram"
                class="h-8 md:h-12 w-auto object-contain">

            <div class="ml-1">
                <h1 class="font-bold text-[10px] md:text-sm lg:text-lg leading-tight text-blue-900">
                    Pemerintah<br class="md:hidden"> Kota Mataram </h1>
            </div>
        </div>

        <nav
            class="hidden lg:flex items-center gap-14 font-medium text-slate-600 bg-slate-50 px-6 py-2 rounded-xl border border-slate-100">
            <a href="{{ request()->routeIs('home') ? '#top' : route('home') }}"
                class="text-sm font-bold transition {{ request()->routeIs('home') ? 'text-blue-700' : 'text-slate-500 hover:text-blue-700' }}">Home</a>
            <a href="{{ route('home') }}#statistik"
                class="text-sm font-bold transition text-slate-500 hover:text-blue-700">Statistik</a>
            <a href="{{ route('home') }}#tabel-kunjungan"
                class="text-sm font-bold transition text-slate-500 hover:text-blue-700">Daftar Pengunjung</a>
            <a href="{{ route('guest.rekap') }}"
                class="text-sm font-bold transition {{ request()->routeIs('guest.rekap') || request()->routeIs('guest.export') ? 'text-blue-700' : 'text-slate-500 hover:text-blue-700' }}">Rekapitulasi</a>
        </nav>

        <div class="flex items-center gap-3">

            @auth
                <div class="hidden xl:block text-right mr-2">
                    <span
                        class="block text-[10px] text-slate-400 font-bold uppercase tracking-wider">{{ Auth::user()->role }}</span>
                    <span class="block text-xs font-bold text-blue-900">{{ Str::limit(Auth::user()->name, 15) }}</span>
                </div>

                <a href="{{ route('dashboard') }}"
                    class="hidden lg:flex bg-blue-50 text-blue-600 p-2.5 rounded-full hover:bg-blue-100 transition border border-blue-100"
                    title="Ke Dashboard">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                </a>

                <form action="{{ route('logout') }}" method="POST" class="hidden lg:block">
                    @csrf
                    <button type="submit"
                        class="bg-red-50 text-red-600 pl-3 pr-4 py-2 rounded-full font-bold text-xs hover:bg-red-600 hover:text-white transition border border-red-100 flex items-center gap-2 group">
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="hidden lg:flex bg-blue-900 text-white px-5 py-2.5 rounded-full font-bold text-xs hover:bg-blue-800 transition shadow-lg shadow-blue-200 items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Login Petugas
                </a>
            @endauth

            <div class="lg:hidden ml-auto relative z-[1001]"> <button id="burger-btn"
                    class="p-2 text-slate-600 bg-slate-50 rounded-lg border border-slate-200 hover:bg-slate-100 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobile-menu"
            class="absolute top-full left-0 w-full lg:hidden bg-white border-b border-t border-slate-100 shadow-xl z-[999]">
            <div class="flex flex-col p-4 space-y-3">
                <a href="{{ request()->routeIs('home') ? '#top' : route('home') }}"
                    class="px-4 py-3 rounded-lg font-bold text-slate-600 hover:bg-slate-50 hover:text-blue-700 transition {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700' : '' }}">Home</a>
                <a href="{{ route('home') }}#statistik"
                    class="px-4 py-3 rounded-lg font-bold text-slate-600 hover:bg-slate-50 hover:text-blue-700 transition">Statistik</a>
                <a href="{{ route('home') }}#tabel-kunjungan"
                    class="px-4 py-3 rounded-lg font-bold text-slate-600 hover:bg-slate-50 hover:text-blue-700 transition">Daftar
                    Pengunjung</a>
                <a href="{{ route('guest.rekap') }}"
                    class="px-4 py-3 rounded-lg font-bold text-slate-600 hover:bg-slate-50 hover:text-blue-700 transition {{ request()->routeIs('guest.rekap') ? 'bg-blue-50 text-blue-700' : '' }}">Rekapitulasi</a>

                <div class="h-px bg-slate-100 my-2"></div>

                @auth
                    <div class="px-4 py-2">
                        <p class="text-xs text-slate-400 font-bold uppercase">Login Sebagai</p>
                        <p class="text-sm font-bold text-blue-900">{{ Auth::user()->name }}</p>
                    </div>
                    <a href="{{ route('dashboard') }}"
                        class="px-4 py-3 rounded-lg font-bold text-slate-600 hover:bg-slate-50 hover:text-blue-700 transition">Dashboard</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-3 rounded-lg font-bold text-red-600 hover:bg-red-50 transition">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="w-full text-center px-4 py-3 rounded-lg font-bold bg-blue-900 text-white shadow-md hover:bg-blue-800 transition">Login
                        Petugas</a>
                @endauth
            </div>
        </div>

    </header>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-white py-8 border-t border-slate-100 text-center text-slate-500 text-sm mt-auto">
        <p>&copy; {{ date('Y') }} Bidang Penyelenggaraan e-Government Dinas Kominfo Kota Mataram. All Rights Reserved.
        </p>
    </footer>

    <script>
        const burgerBtn = document.getElementById('burger-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        burgerBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('open');
        });

        // Tutup menu saat scroll
        window.addEventListener('scroll', () => {
            if (mobileMenu.classList.contains('open')) {
                mobileMenu.classList.remove('open');
            }
        });

        // Tutup menu saat klik link di dalamnya
        mobileMenu.addEventListener('click', (event) => {
            if (event.target.tagName === 'A' || event.target.tagName === 'BUTTON') {
                mobileMenu.classList.remove('open');
            }
        });

        // Tutup menu saat klik di mana saja (termasuk di dalam menu saat pilih link, atau di luar)
        document.addEventListener('click', (event) => {
            const isClickOnButton = burgerBtn.contains(event.target);
            const isClickOnMenu = mobileMenu.contains(event.target);

            // Jika menu terbuka DAN klik bukan di tombol burger DAN bukan di dalam menu -> Tutup menu
            if (mobileMenu.classList.contains('open') && !isClickOnButton && !isClickOnMenu) {
                mobileMenu.classList.remove('open');
            }
        });
    </script>
</body>

</html>