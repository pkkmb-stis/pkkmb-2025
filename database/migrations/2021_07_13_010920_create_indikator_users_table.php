<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndikatorUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indikator_users', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->float('nilai');
            $table->unsignedSmallInteger('ternilai_id');
            $table->foreign('ternilai_id')->references('id')->on('users');
            $table->unsignedSmallInteger('penilai_id');
            $table->foreign('penilai_id')->references('id')->on('users');
            $table->foreignId('indikator_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indikator_users');
    }
}
