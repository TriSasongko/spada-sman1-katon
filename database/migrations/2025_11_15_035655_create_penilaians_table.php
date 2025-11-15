<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guru_id');
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('kelas_id');
            $table->string('kategori'); // UTS, UAS, Tugas, dll
            $table->decimal('nilai', 5, 2)->nullable();
            $table->text('deskripsi')->nullable();
            $table->date('tanggal')->nullable();
            $table->timestamps();

            $table->foreign('guru_id')->references('id')->on('gurus')->cascadeOnDelete();
            $table->foreign('siswa_id')->references('id')->on('siswas')->cascadeOnDelete();
            $table->foreign('kelas_id')->references('id')->on('kelas')->cascadeOnDelete();
        });
    }

    public function down(): void {
        Schema::dropIfExists('penilaians');
    }
};
