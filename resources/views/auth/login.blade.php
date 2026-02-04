@extends('layouts.app')

@section('content')
<div class="relative min-h-screen flex items-center justify-center bg-slate-50 overflow-hidden py-10 px-4">
    
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-[-10%] right-[-5%] w-96 h-96 bg-blue-100/50 rounded-full blur-3xl opacity-60"></div>
        <div class="absolute bottom-[-10%] left-[-5%] w-96 h-96 bg-yellow-100/50 rounded-full blur-3xl opacity-60"></div>
    </div>

    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl border border-blue-50 overflow-hidden relative z-10">
        
        <div class="bg-blue-900 pt-10 pb-20 px-8 text-center relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white"></path>
                </svg>
            </div>

            <div class="relative z-10">
                <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg border-4 border-blue-100">
                    <img src="{{ asset('assets/img/logo_mataram.jpeg') }}" 
                         alt="Logo Kota Mataram" 
                         class="w-12 h-auto">
                </div>
                <h2 class="text-2xl font-extrabold text-white tracking-wide">Administrator</h2>
                <p class="text-blue-200 text-sm mt-1">Silakan masuk untuk mengelola data.</p>
            </div>
        </div>

        <div class="px-8 pb-8 -mt-10 relative z-20">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                
                <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wide">Email Dinas</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                            </div>
                            <input type="email" name="email" required autofocus placeholder="nama@mataram.go.id"
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition text-sm font-medium">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wide">Kata Sandi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input type="password" name="password" required placeholder="••••••••"
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition text-sm font-medium">
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-blue-900 hover:bg-blue-800 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-blue-900/20 transition transform hover:-translate-y-0.5 flex justify-center items-center gap-2">
                        <span>MASUK SISTEM</span>
                    </button>

                </form>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-1 text-xs font-bold text-slate-400 hover:text-blue-900 transition">
                    Kembali ke Halaman Tamu
                </a>
            </div>
        </div>
    </div>

</div>
@endsection