@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-slate-50 py-12 flex items-center justify-center">
        <div class="bg-white p-8 rounded-3xl shadow-xl border border-blue-50 w-full max-w-lg">
            <h2 class="text-2xl font-extrabold text-blue-900 mb-6 text-center">Tambah Pengguna Baru</h2>

            <form action="{{ route('users.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1 uppercase">Nama Lengkap</label>
                    <input type="text" name="name" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1 uppercase">Email Address</label>
                    <input type="email" name="email" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1 uppercase">Role / Jabatan</label>
                    <select name="role"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="petugas">Petugas Piket</option>
                        <option value="superadmin">Super Admin</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1 uppercase">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none pr-12">
                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-blue-600 focus:outline-none transition-all duration-200">
                            <svg id="eyeIcon" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            <svg id="eyeOffIcon" class="w-5 h-5 hidden" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                                <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68" />
                                <path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61" />
                                <line x1="2" x2="22" y1="2" y2="22" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex gap-3 pt-4">
                    <a href="{{ route('users.index') }}"
                        class="w-1/2 bg-slate-100 text-slate-600 font-bold py-3 rounded-xl text-center hover:bg-slate-200 transition">Batal</a>
                    <button type="submit"
                        class="w-1/2 bg-blue-900 text-white font-bold py-3 rounded-xl hover:bg-blue-800 transition shadow-lg">Simpan</button>
                </div>
            </form>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const togglePassword = document.querySelector('#togglePassword');
                    const password = document.querySelector('#password');
                    const eyeIcon = document.querySelector('#eyeIcon');
                    const eyeOffIcon = document.querySelector('#eyeOffIcon');

                    togglePassword.addEventListener('click', function () {
                        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                        password.setAttribute('type', type);

                        if (type === 'password') {
                            eyeIcon.classList.remove('hidden');
                            eyeOffIcon.classList.add('hidden');
                        } else {
                            eyeIcon.classList.add('hidden');
                            eyeOffIcon.classList.remove('hidden');
                        }
                    });
                });
            </script>
        </div>
    </div>
@endsection