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
        Schema::create('mata_pelajaran', function (Blueprint $table) {
            $table->id('id_mata_pelajaran');
            $table->string('nama');
            $table->unsignedBigInteger('guru_kelas_id')->nullable(); // relasi opsional
            $table->timestamps();
            $table->foreign('guru_kelas_id')->references('id_guru_kelas')->on('guru_kelas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_pelajarans');
    }
};
