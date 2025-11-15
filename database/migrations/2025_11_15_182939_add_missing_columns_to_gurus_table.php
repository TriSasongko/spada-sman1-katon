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
        Schema::table('gurus', function (Blueprint $table) {
            // Tambahkan kolom jenis_kelamin jika belum ada
            if (!Schema::hasColumn('gurus', 'jenis_kelamin')) {
                $table->enum('jenis_kelamin', ['L', 'P'])->after('nip')->nullable();
            }

            // Tambahkan kolom telepon
            if (!Schema::hasColumn('gurus', 'telepon')) {
                $table->string('telepon', 20)->after('jenis_kelamin')->nullable();
            }

            // Tambahkan kolom email
            if (!Schema::hasColumn('gurus', 'email')) {
                $table->string('email')->after('telepon')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            if (Schema::hasColumn('gurus', 'jenis_kelamin')) {
                $table->dropColumn('jenis_kelamin');
            }
            if (Schema::hasColumn('gurus', 'telepon')) {
                $table->dropColumn('telepon');
            }
            if (Schema::hasColumn('gurus', 'email')) {
                $table->dropColumn('email');
            }
        });
    }
};
