<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToPublishableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('publishable', function (Blueprint $table) {
            $table->string('image')->nullable()->after('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('publishable', function (Blueprint $table) {
            Schema::table('publishable', function (Blueprint $table) {
                $table->dropColumn('image');
            });
        });
    }
}
