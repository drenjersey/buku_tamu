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

        .btn-primary {
            background-color: #0F172A;
            color: white;
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #1E293B;
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="bg-soft text-slate-800">
    <!-- Header -->
    <header class="bg-white py-4 px-6 md:px-12 flex items-center justify-between sticky top-0 z-50 shadow-sm">
        <div class="flex items-center gap-4">
            <img src="/assets/img/logo_mataram.jpeg" alt="Logo Mataram" class="h-12 w-auto">
            <div>
                <h1 class="font-bold text-lg leading-tight text-blue-900">Pemerintah<br>Kota Mataram</h1>
            </div>

        </div>

        <nav class="hidden lg:flex items-center gap-8 font-medium text-slate-600">

            {{-- 1. MENU HOME --}}
            <a href="{{ route('home') }}"
                class="{{ request()->routeIs('home')
    ? 'text-blue-700 font-bold border-b-2 border-blue-700'
    : 'text-gray-600 hover:text-blue-700 transition border-b-2 border-transparent hover:border-blue-700' }}">
                Home
            </a>

            {{-- 2. MENU ISI FORM --}}
            {{-- Menggunakan 'guest.*' agar tetap aktif saat di halaman create atau store --}}
            <a href="{{ route('guest.create') }}"
                class="text-sm font-bold {{ request()->routeIs('guest.*')
    ? 'text-blue-700 border-b-2 border-blue-700'
    : 'text-gray-600 hover:text-blue-700 transition border-b-2 border-transparent hover:border-blue-700' }}">
                Isi Form
            </a>

            {{-- 3. MENU REKAP --}}
            <a href="{{ route('guest.rekap') }}"
                class="text-sm font-bold {{ request()->routeIs('guest.rekap')
    ? 'text-blue-700 border-b-2 border-blue-700'
    : 'text-gray-600 hover:text-blue-700 transition border-b-2 border-transparent hover:border-blue-700' }}">
                Rekap
            </a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <!-- Footer Simple -->
    <footer class="bg-white py-8 border-t border-slate-100 text-center text-slate-500 text-sm">
        <p>&copy; 2024 Pemerintah Kota Mataram. All Rights Reserved.</p>
    </footer>
</body>

</html>