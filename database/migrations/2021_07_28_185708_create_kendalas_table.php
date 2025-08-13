<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKendalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('laporan');
        Schema::create('kendala', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('user_id')->nullable();
            $table->text('content');
            $table->unsignedTinyInteger('category');
            $table->unsignedTinyInteger('status')->default(0);
            $table->text('tanggapan')->nullable();
            $table->string('foto_kendala')->nullable();
            $table->string('foto_perlengkapan')->nullable();
            $table->string('foto_atribute')->nullable();
            $table->timestamp('waktu_kendala')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kendala');
    }
}
