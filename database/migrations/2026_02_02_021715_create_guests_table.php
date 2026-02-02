<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tamu');          // Nama orang perwakilan
            $table->string('asal_instansi');      // Field "kunjungan" (Asal Instansi)
            $table->integer('jumlah_personil');   // Field "jmlh personil"
            $table->text('keperluan');            // Field "keperluan"
            $table->string('penerima_kunjungan'); // Field "penerima kunjungan"
            $table->date('tanggal_kunjungan');    // Field "tgl kunjungan"
            $table->timestamps();                 // Waktu input data (otomatis)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};