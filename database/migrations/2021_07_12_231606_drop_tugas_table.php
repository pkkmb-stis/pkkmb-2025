<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tugas');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->integer('nilai');
            $table->foreignId('tugas_id');
            $table->smallInteger('maba_user_id',false,true);
            $table->foreign('maba_user_id')->references('id')->on('users');
            $table->string('status',40);
            $table->timestamp('submited_at')->useCurrent();
            $table->timestamps();
        });
    }
}
