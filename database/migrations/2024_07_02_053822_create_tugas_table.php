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
        Schema::create('tugas', function (Blueprint $table) {
            $table->id('id_tugas');
            $table->unsignedBigInteger('id_mapel');
            $table->unsignedBigInteger('id_kelas');
            $table->string('deskripsi');
            $table->datetime('dateline');
            $table->longtext('no_tugas');
            $table->longtext('konten');
            $table->timestamps();

            $table->foreign('id_mapel')->references('id_mapel')->on('mapels')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
