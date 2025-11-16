<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // contoh: X IPA 1
            $table->unsignedBigInteger('guru_id'); // wali kelas
            $table->unsignedBigInteger('jurusan_id'); // jurusan
            $table->timestamps();

            $table->foreign('guru_id')
                ->references('id')->on('gurus')
                ->cascadeOnDelete();

            $table->foreign('jurusan_id')
                ->references('id')->on('jurusans')
                ->cascadeOnDelete();
        });
    }

    public function down(): void {
        Schema::dropIfExists('kelas');
    }
};
