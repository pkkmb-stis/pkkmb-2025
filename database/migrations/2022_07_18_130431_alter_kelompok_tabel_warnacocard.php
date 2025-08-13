<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterKelompokTabelWarnacocard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tambah kolom jenis_kelompok
        Schema::table('kelompok', function (Blueprint $table) {
            $table->string('warna_co_card');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Hapus kolom jenis_kelompok
        Schema::table('kelompok', function (Blueprint $table) {
            $table->dropColumn('warna_co_card');
        });
    }
}
