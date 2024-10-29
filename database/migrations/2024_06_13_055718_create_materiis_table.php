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
        Schema::create('materiis', function (Blueprint $table) {
            $table->id('id_materi');
            $table->unsignedBigInteger('id_mapel');
            $table->unsignedBigInteger('id_pengajar');
            $table->string('status');
            $table->string('judul_materi');
            $table->string('deskripsi');
            $table->longText('konten');
            $table->string('video_url')->nullable(); // Untuk link video (opsional)
            $table->string('gambar_url')->nullable(); // Untuk link gambar (opsional)
            $table->timestamps();
            
         

       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiis');
    }
};
