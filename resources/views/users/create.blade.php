@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-12 flex items-center justify-center">
    <div class="bg-white p-8 rounded-3xl shadow-xl border border-blue-50 w-full max-w-lg">
        <h2 class="text-2xl font-extrabold text-blue-900 mb-6 text-center">Tambah Pengguna Baru</h2>

        <form action="{{ route('users.store') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-1 uppercase">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 mb-1 uppercase">Email Address</label>
                <input type="email" name="email" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 mb-1 uppercase">Role / Jabatan</label>
                <select name="role" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="petugas">Petugas Piket</option>
                    <option value="superadmin">Super Admin</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 mb-1 uppercase">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div class="flex gap-3 pt-4">
                <a href="{{ route('users.index') }}" class="w-1/2 bg-slate-100 text-slate-600 font-bold py-3 rounded-xl text-center hover:bg-slate-200 transition">Batal</a>
                <button type="submit" class="w-1/2 bg-blue-900 text-white font-bold py-3 rounded-xl hover:bg-blue-800 transition shadow-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection