<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterKelompokTableJeniskelompok extends Migration
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
            $table->string('jenis_kelompok')->default(0);
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
            $table->dropColumn('jenis_kelompok');
        });
    }
}
