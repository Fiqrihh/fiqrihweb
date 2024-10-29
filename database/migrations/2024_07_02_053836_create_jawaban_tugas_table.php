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
        Schema::create('jawaban_tugas', function (Blueprint $table) {
            $table->id('id_jawabanTugas');
            $table->unsignedBigInteger('id_mapel');
            $table->unsignedBigInteger('id_tugas');
            $table->unsignedBigInteger('id_murid');
            $table->unsignedBigInteger('id_kelas');
            $table->longText('jawaban_text');
            $table->string('jawaban_file');
            $table->decimal('nilai_tugas',3 );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_tugas');
    }
};
