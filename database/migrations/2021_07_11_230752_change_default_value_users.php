<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDefaultValueUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('alamat')->nullable()->change();
            $table->string('nowa', 14)->nullable()->change();
            $table->string('angkatan', 2)->nullable()->change();
            $table->integer('is_active')->nullable()->change();
            $table->smallInteger('kabkot_id',false,true)->nullable()->change();
            $table->smallInteger('kelompok_id',false,true)->nullable()->change();
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
            $table->text('alamat')->nullable(false)->change();
            $table->string('nowa', 14)->nullable(false)->change();
            $table->string('angkatan', 2)->nullable(false)->change();
            $table->integer('is_active')->nullable(false)->change();
            $table->smallInteger('kabkot_id',false,true)->nullable(false)->change();
            $table->smallInteger('kelompok_id',false,true)->nullable(false)->change();
        });
    }
}
