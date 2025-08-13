<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropIsPascaFieldFromJenisPoinUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jenis_poin_user', function (Blueprint $table) {
            $table->dropColumn('is_pasca');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jenis_poin_user', function (Blueprint $table) {
            $table->integer('is_pasca',false,false)->default('0');
        });
    }
}
