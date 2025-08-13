<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublishableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publishable', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('title',150);
            $table->text('content');
            $table->text('link')->nullable();
            $table->timestamp('publish_datetime')->useCurrent();
            $table->integer('category',false,false)->nullable();
            // * Domain category:
            // * 1 => Pengumuman
            // * 2 => Materi
            // * 3 => Sertifikat

            $table->foreignId('user_id')->nullable();
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
        Schema::dropIfExists('publishable');
    }
}
