<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterGallery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('foto', 'gallery');
        Schema::table('gallery', function (Blueprint $table) {
            $table->dropColumn('publish_datetime');
            $table->unsignedTinyInteger('urutan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gallery', function (Blueprint $table) {
            $table->timestamp('publish_datetime')->nullable();
        });
        Schema::rename('gallery', 'foto');
    }
}
