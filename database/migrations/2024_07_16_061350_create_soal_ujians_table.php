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
        Schema::create('soal_ujians', function (Blueprint $table) {
            $table->id('id_soalUjian');
            $table->unsignedBigInteger('id_ujian');
            $table->unsignedBigInteger('id_mapel');
            $table->datetime('waktu_mulai');
            $table->datetime('waktu_berakhir');
            $table->string('Deskripsi');
            $table->text('pertanyaan'); // Kolom untuk menyimpan pertanyaan
            $table->timestamps();
            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_ujians');
    }
};
