<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableAgain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nimb', 7)->nullable();
            $table->unsignedTinyInteger('status_kelulusan')->nullable()->default(0);
        });

        Schema::table('events', function (Blueprint $table) {
            $table->string('link_lambat')->nullable();
        });

        Schema::table('events_user', function (Blueprint $table) {
            $table->string('link')->nullable();
        });

        Schema::table('kelompok', function (Blueprint $table) {
            $table->text('link_classroom')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nimb');
            $table->dropColumn('status_kelulusan');
        });

        Schema::table('events_user', function (Blueprint $table) {
            $table->dropColumn('link');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('link_lambat');
        });

        Schema::table('kelompok', function (Blueprint $table) {
            $table->dropColumn('link_classroom');
        });
    }
}
