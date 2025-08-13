<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEventIdToGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gallery', function (Blueprint $table) {
            // Menggunakan unsignedTinyInteger untuk mencocokkan tipe data dengan kolom id di tabel events
            $table->unsignedTinyInteger('event_id')->nullable()->after('id');

            // Menambahkan foreign key constraint ke tabel events
            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onDelete('cascade');
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
            // Menghapus foreign key constraint
            $table->dropForeign(['event_id']);

            // Menghapus kolom event_id
            $table->dropColumn('event_id');
        });
    }
}
