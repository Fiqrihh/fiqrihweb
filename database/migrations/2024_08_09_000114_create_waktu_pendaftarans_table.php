<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('waktu_pendaftarans', function (Blueprint $table) {
            $table->id('id_Wpendaftaran');
            $table->string('status')->default('tutup');
            $table->string('teks_pendaftaran')->default('pendaftaran sedang di tutup');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waktu_pendaftarans');
    }
};
