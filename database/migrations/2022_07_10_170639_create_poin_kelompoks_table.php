<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoinKelompoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poin_kelompoks', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('kelompok_id', false, true);
            $table->foreign('kelompok_id')->references('id')->on('kelompok');
            $table->foreignId('jenis_poin_id')->nullable();
            $table->tinyInteger('poin', false, false)->nullable()->default('0');
            $table->timestamp('hari')->nullable();
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
        Schema::dropIfExists('poin_kelompoks');
    }
}