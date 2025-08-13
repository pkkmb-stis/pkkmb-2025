<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->tinyInteger('id', true, true);
            $table->string('title', 150);
            $table->string('eventcode', 50)->nullable();
            $table->text('caption');
            $table->tinyInteger('category')->unsigned()->nullable();
            $table->tinyInteger('is_pasca')->default(0);
            $table->text('link')->nullable();
            $table->timestamp('waktu_mulai')->nullable();
            $table->timestamp('waktu_akhir')->nullable();
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
        Schema::dropIfExists('events');
    }
}
