<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterKelompok extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('kelompok_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('kelompok_id')->unsigned()->nullable();
            $table->foreign('kelompok_id')
                ->references('id')
                ->on('kelompok')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });

        Schema::table('kelompok', function (Blueprint $table) {
            $table->string('description', 255)->nullable();
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
            $table->dropForeign(['kelompok_id']);
        });

        Schema::table('kelompok', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
}
