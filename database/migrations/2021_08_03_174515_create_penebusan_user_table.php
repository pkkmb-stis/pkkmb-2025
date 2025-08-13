<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenebusanUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penebusan_user', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->foreignId('user_id');
            $table->foreignId('jenis_poin_id');
            $table->timestamp('deadline')->nullable();
            $table->unsignedBigInteger('poin_id')->nullable();
            $table->foreign('poin_id')->references('id')->on('jenis_poin_user');
            $table->string('status', 20);
            $table->text('link')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamp('taken_at')->useCurrent();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('submited_at')->nullable();
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
        Schema::dropIfExists('penebusan_user');
    }
}
