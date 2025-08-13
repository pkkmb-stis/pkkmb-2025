<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewKabkotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kabkot', function (Blueprint $table) {
            $table->mediumInteger('kabkot_id',false,true)->primary();
            $table->smallInteger('prov_id',false,true);
            $table->foreign('prov_id')->references('prov_id')->on('provinsi');
            $table->string('nama',60);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kabkot');
    }
}
