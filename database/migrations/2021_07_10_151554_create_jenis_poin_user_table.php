<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisPoinUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_poin_user', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('user_id', false, true);
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('is_pasca',false,false)->default('0');
            $table->foreignId('jenis_poin_id')->nullable();
            $table->tinyInteger('poin', false, false)->nullable()->default('0');
            $table->text('alasan')->nullable();
            $table->timestamp('urutan_input')->nullable();
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
        Schema::dropIfExists('jenis_poin_user');
    }
}
