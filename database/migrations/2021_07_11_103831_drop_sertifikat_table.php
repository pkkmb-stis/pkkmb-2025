<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSertifikatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sertifikat');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('sertifikat', function (Blueprint $table) {
            $table->id();
            $table->string('title',40);
            $table->text('caption');
            $table->timestamp('publish_datetime');
            $table->integer('category',false,false)->nullable();
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }
}
