<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun SUPER ADMIN (Si Bos)
        User::create([
            'name' => 'Super Administrator',
            'email' => 'super@mataram.go.id',
            'password' => Hash::make('password'), // Passwordnya 'password'
            'role' => 'superadmin', // Kuncinya disini
        ]);

        // 2. Buat Akun PETUGAS (Bawahan)
        User::create([
            'name' => 'Budi Petugas',
            'email' => 'petugas@mataram.go.id',
            'password' => Hash::make('password'),
            'role' => 'petugas', // Kuncinya disini
        ]);
    }
}