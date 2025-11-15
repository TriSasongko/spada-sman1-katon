<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pertemuan_id');
            $table->unsignedBigInteger('siswa_id');
            $table->enum('status', ['hadir', 'izin', 'sakit'])->default('hadir');
            $table->string('metode')->nullable(); // manual/kode/qr
            $table->timestamps();

            $table->foreign('pertemuan_id')->references('id')->on('pertemuans')->cascadeOnDelete();
            $table->foreign('siswa_id')->references('id')->on('siswas')->cascadeOnDelete();
        });
    }

    public function down(): void {
        Schema::dropIfExists('presensis');
    }
};
