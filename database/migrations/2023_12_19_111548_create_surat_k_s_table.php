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
        Schema::create('surat_k_s', function (Blueprint $table) {
            $table->id();
            $table->string('Penerima');
            $table->string('judulSuratK');
            $table->string('nomorSuratK');
            $table->string('isiSuratK');
            $table->string('fileSuratK');
            $table->string('tglSuratK');
            $table->string('tempat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_k_s');
    }
};
