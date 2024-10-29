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
        Schema::create('tugas_nilais', function (Blueprint $table) {
            $table->id('id_Ntugas');
            $table->unsignedBigInteger('id_tugass');
            $table->unsignedBigInteger('id_mapel');
            $table->unsignedBigInteger('id_murid'); //id santri
            $table->string('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas_nilais');
    }
};
