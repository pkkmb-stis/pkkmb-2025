<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterJenisPoin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jenis_poin', function (Blueprint $table) {
            $table->dropColumn('detail');
        });

        Schema::table('jenis_poin', function (Blueprint $table) {
            $table->text('detail')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jenis_poin', function (Blueprint $table) {
            $table->dropColumn('detail');
        });

        Schema::table('jenis_poin', function (Blueprint $table) {
            $table->text('detail')->nullable();
        });
    }
}
