@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-12 flex items-center justify-center">
    <div class="bg-white p-8 rounded-3xl shadow-xl border border-blue-50 w-full max-w-lg">
        <h2 class="text-2xl font-extrabold text-blue-900 mb-6 text-center">Edit Data Pengguna</h2>

        <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-1 uppercase">Nama Lengkap</label>
                <input type="text" name="name" value="{{ $user->name }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 mb-1 uppercase">Email Address</label>
                <input type="email" name="email" value="{{ $user->email }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 mb-1 uppercase">Role / Jabatan</label>
                <select name="role" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas Piket</option>
                    <option value="superadmin" {{ $user->role == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                </select>
            </div>

            <div class="bg-yellow-50 p-4 rounded-xl border border-yellow-100">
                <label class="block text-xs font-bold text-yellow-700 mb-1 uppercase">Ganti Password (Opsional)</label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengganti" class="w-full px-4 py-3 bg-white border border-yellow-200 rounded-xl focus:ring-2 focus:ring-yellow-500 outline-none">
                <p class="text-[10px] text-yellow-600 mt-1">*Minimal 6 karakter jika diganti.</p>
            </div>

            <div class="flex gap-3 pt-4">
                <a href="{{ route('users.index') }}" class="w-1/2 bg-slate-100 text-slate-600 font-bold py-3 rounded-xl text-center hover:bg-slate-200 transition">Batal</a>
                <button type="submit" class="w-1/2 bg-blue-900 text-white font-bold py-3 rounded-xl hover:bg-blue-800 transition shadow-lg">Update Data</button>
            </div>
        </form>
    </div>
</div>
@endsection