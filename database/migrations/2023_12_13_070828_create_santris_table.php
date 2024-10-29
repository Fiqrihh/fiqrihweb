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
        Schema::create('santris', function (Blueprint $table) {
            $table->id('id_murid');
            $table->unsignedBigInteger('id_kelas');
            $table->string('nama_lengkap');
            $table->string('alamat');
            $table->string('nohp');
            $table->string('jenis_kelamin');
            $table->string('tanggal_lahir');
            $table->string('email_murid');
            $table->string('fotoSiwa')->nullable();
            $table->string('username')->nullable();                 // bahan untuk login\\
            $table->string('status')->nullable();  
            $table->string('password')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santris');
    }
};
