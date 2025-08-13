<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('jenis_kelamin', 1)->nullable();
            $table->string('nama_statistik', 30)->nullable();
            $table->string('prodi', 30)->nullable();
        });

        Schema::table('kelompok', function (Blueprint $table) {
            $table->text('link_zoom')->after('link_group_wa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('jenis_kelamin');
            $table->dropColumn('nama_statistik');
            $table->dropColumn('prodi');
        });

        Schema::table('kelompok', function (Blueprint $table) {
            $table->dropColumn('link_zoom');
        });
    }
}
