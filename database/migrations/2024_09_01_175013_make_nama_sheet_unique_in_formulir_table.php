<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeNamaSheetUniqueInFormulirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formulir', function (Blueprint $table) {
            $table->string('nama_sheet')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('formulir', function (Blueprint $table) {
            $table->dropUnique(['nama_sheet']);
            $table->string('nama_sheet')->change();
        });
    }
}
