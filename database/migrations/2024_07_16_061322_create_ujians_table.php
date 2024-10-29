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
        Schema::create('ujians', function (Blueprint $table) {
            $table->id('id_ujian');
            $table->unsignedBigInteger('id_mapel');
            $table->unsignedBigInteger('id_kelas');
            $table->datetime('waktu_mulai');
            $table->datetime('waktu_berakhir');
            $table->string('Deskripsi');
            $table->text('pertanyaan');
            $table->text('audio_ujian');
            $table->timestamps();

            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
            $table->foreign('id_mapel')->references('id_mapel')->on('mapels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ujians');
    }
};
