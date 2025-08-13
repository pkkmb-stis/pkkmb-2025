<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterJenisPoinTabelIsbintang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tambah kolom is_bintang
        Schema::table('jenis_poin', function (Blueprint $table) {
            $table->smallInteger('is_bintang', false, false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Hapus kolom is_bintang
        Schema::table('jenis_poin', function (Blueprint $table) {
            $table->dropColumn('is_bintang');
        });
    }
}
