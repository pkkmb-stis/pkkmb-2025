<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulirVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulir_verifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formulir_id');
            $table->string('nimb');
            $table->timestamps();

            $table->foreign('formulir_id')
                ->references('id')
                ->on('formulir')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formulir_verifications');
    }
}
