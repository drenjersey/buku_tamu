<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('guests', function (Blueprint $table) {
            // Ensure foto_path is nullable
            $table->text('foto_path')->nullable()->change();
            // Ensure kontak is nullable (just to be safe/double check)
            $table->string('kontak')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guests', function (Blueprint $table) {
            // Reverting logic if needed, though typically we wouldn't want to make it required again
            // $table->text('foto_path')->nullable(false)->change(); 
        });
    }
};
