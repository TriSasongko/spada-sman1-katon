<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pengumumans', function (Blueprint $table) {
            if (!Schema::hasColumn('pengumumans', 'file_path')) {
                $table->string('file_path')->nullable()->after('isi');
            }

            if (!Schema::hasColumn('pengumumans', 'target')) {
                // target: all_students, all_gurus, all, kelas, guru
                $table->string('target')->default('all_students')->after('file_path');
            }

            if (!Schema::hasColumn('pengumumans', 'target_ids')) {
                $table->json('target_ids')->nullable()->after('target');
            }

            if (!Schema::hasColumn('pengumumans', 'published_at')) {
                $table->dateTime('published_at')->nullable()->after('target_ids');
            }

            if (!Schema::hasColumn('pengumumans', 'kirim_notifikasi')) {
                $table->boolean('kirim_notifikasi')->default(true)->after('published_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengumumans', function (Blueprint $table) {
            foreach (['file_path', 'target', 'target_ids', 'published_at', 'kirim_notifikasi'] as $col) {
                if (Schema::hasColumn('pengumumans', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
