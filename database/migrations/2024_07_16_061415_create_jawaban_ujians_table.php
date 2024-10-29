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
        Schema::create('jawaban_ujians', function (Blueprint $table) {
            $table->id('id_jawabanUjian');
            $table->unsignedBigInteger('id_ujian');
            $table->unsignedBigInteger('id_murid');
            $table->unsignedBigInteger('id_mapel');
            $table->unsignedBigInteger('id_kelas');
            $table->text('student_ans');
            $table->decimal('nilai_ujian',3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_ujians');
    }
};
