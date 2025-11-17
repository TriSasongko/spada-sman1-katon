<?php

// database/migrations/2025_11_18_..._add_role_id_to_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom role_id
            $table->foreignId('role_id')->nullable()->after('password')->constrained('roles')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus foreign key dan kolom saat rollback
            $table->dropConstrainedForeignId('role_id');
        });
    }
};
