<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('presensis', function (Blueprint $table) {
            $table->unsignedBigInteger('kelas_id')->after('id');
            $table->unsignedBigInteger('mapel_id')->after('kelas_id');
            $table->unsignedBigInteger('guru_id')->after('mapel_id');
            $table->date('tanggal')->after('guru_id');

            $table->dropColumn('pertemuan_id');
        });
    }

    public function down()
    {
        Schema::table('presensis', function (Blueprint $table) {
            $table->unsignedBigInteger('pertemuan_id')->nullable();
            $table->dropColumn(['kelas_id', 'mapel_id', 'guru_id', 'tanggal']);
        });
    }
};
