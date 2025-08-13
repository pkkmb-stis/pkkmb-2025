<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableIndikator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indikator', function (Blueprint $table) {
            $table->string('dimensi', 40);
            $table->tinyInteger('sks');
            $table->dropColumn('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('indikator', function (Blueprint $table) {
            $table->dropColumn('sks');
            $table->dropColumn('dimensi');
            $table->string('category', 60);
        });
    }
}
