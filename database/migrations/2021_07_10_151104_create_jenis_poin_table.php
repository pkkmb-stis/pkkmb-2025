<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisPoinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_poin', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('nama');
            $table->integer('category',false,false);
            // * Domain category:
            // * 1 => Bonus
            // * 2 => Pelanggaran
            // * 3 => Penebusan

            $table->integer('type',false,false)->nullable();
            $table->integer('poin',false,true)->default(0);
            $table->integer('deadline',false,true)->nullable();
            $table->text('detail');
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
        Schema::dropIfExists('jenis_poin');
    }
}
