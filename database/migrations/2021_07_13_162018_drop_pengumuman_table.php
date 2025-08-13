<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPengumumanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pengumuman');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('title',150);
            $table->integer('category',false,false)->nullable();
            $table->text('content');
            $table->timestamp('publish_datetime')->useCurrent();
            $table->timestamps();
        });
    }
}
