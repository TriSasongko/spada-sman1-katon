<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pertemuans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('guru_id');
            $table->date('tanggal');
            $table->string('kode_presensi')->nullable();
            $table->timestamps();

            $table->foreign('kelas_id')->references('id')->on('kelas')->cascadeOnDelete();
            $table->foreign('guru_id')->references('id')->on('gurus')->cascadeOnDelete();
        });
    }

    public function down(): void {
        Schema::dropIfExists('pertemuans');
    }
};
