<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemerintah Kota Mataram - Mataram Harum | Harmoni</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .bg-soft {
            background-color: #F8FAFC;
        }
    </style>
</head>

<body class="bg-soft text-slate-800 flex flex-col min-h-screen">
    
    <header class="bg-white py-4 px-6 md:px-12 flex items-center justify-between sticky top-0 z-50 shadow-sm transition-all duration-300">
        
        <div class="flex items-center gap-4">
            <img src="{{ asset('assets/img/logo_kominfo.png') }}" alt="Logo Kominfo" class="h-10 md:h-12 w-auto object-contain">
            
            <div class="h-8 w-px bg-slate-200 hidden md:block"></div>

            <img src="{{ asset('assets/img/logo_mataram.jpeg') }}" alt="Logo Mataram" class="h-10 md:h-12 w-auto object-contain hidden md:block">
            
            <div>
                <h1 class="font-bold text-sm md:text-lg leading-tight text-blue-900 whitespace-nowrap">
                    Pemerintah Kota Mataram
                </h1>
            </div>
        </div>

        <nav class="hidden lg:flex items-center gap-8 font-medium text-slate-600 bg-slate-50 px-6 py-2 rounded-full border border-slate-100">

            {{-- MENU HOME --}}
            <a href="{{ route('home') }}"
                class="text-sm font-bold transition {{ request()->routeIs('home') ? 'text-blue-700' : 'text-slate-500 hover:text-blue-700' }}">
                Home
            </a>

            {{-- MENU REKAP --}}
            <a href="{{ route('guest.rekap') }}"
                class="text-sm font-bold transition {{ request()->routeIs('guest.rekap') || request()->routeIs('guest.export') ? 'text-blue-700' : 'text-slate-500 hover:text-blue-700' }}">
                Rekap
            </a>
            
        </nav>

        <div class="flex items-center gap-3">
            
            @auth
                <div class="hidden xl:block text-right mr-2">
                    <span class="block text-[10px] text-slate-400 font-bold uppercase tracking-wider">{{ Auth::user()->role }}</span>
                    <span class="block text-xs font-bold text-blue-900">{{ Str::limit(Auth::user()->name, 15) }}</span>
                </div>

                <a href="{{ route('dashboard') }}" class="hidden lg:flex bg-blue-50 text-blue-600 p-2.5 rounded-full hover:bg-blue-100 transition border border-blue-100" title="Ke Dashboard">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-50 text-red-600 pl-3 pr-4 py-2 rounded-full font-bold text-xs hover:bg-red-600 hover:text-white transition border border-red-100 flex items-center gap-2 group">
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="bg-blue-900 text-white px-5 py-2.5 rounded-full font-bold text-xs hover:bg-blue-800 transition shadow-lg shadow-blue-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Login Petugas
                </a>
            @endauth

            <div class="lg:hidden ml-2">
                 <button class="p-2 text-slate-600 bg-slate-50 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>

    </header>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-white py-8 border-t border-slate-100 text-center text-slate-500 text-sm mt-auto">
        <p>&copy; {{ date('Y') }} Pemerintah Kota Mataram. All Rights Reserved.</p>
    </footer>
</body>
</html>