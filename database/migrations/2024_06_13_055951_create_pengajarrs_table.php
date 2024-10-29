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
        Schema::create('pengajarrs', function (Blueprint $table) {
            $table->id('id_pengajar');
            $table->string('namaP');
            $table->date('tgl_lahirP');
            $table->string('Alamat');
            $table->string('No_hp_pengajar');
            $table->string('jenis_kelaminP');
            $table->string('username')->nullable();
            $table->string('fotoPengajar')->nullable();
            $table->string('password')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajarrs');
    }
};
