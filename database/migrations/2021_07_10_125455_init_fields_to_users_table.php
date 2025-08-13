<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 21)->unique()->after('id');
            $table->text('alamat')->after('username');
            $table->string('nowa', 15)->after('alamat');
            // $table->foreign('kabkot_id')->references('id')->on('kabkot')->after('nowa');
            $table->string('himada', 60)->nullable()->after('nowa');
            $table->string('angkatan', 2)->after('himada');
            $table->integer('is_active')->default(1);
            // $table->foreign('kelompok_id')->references('id')->on('kelompok')->after('angkatan');
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
            $table->dropColumn('username');
            $table->dropColumn('alamat');
            $table->dropColumn('nowa');
            // $table->dropColumn('kabkot_id');
            $table->dropColumn('himada');
            $table->dropColumn('angkatan');
            // $table->dropColumn('kelompok_id');
            $table->dropColumn('is_active');
        });
    }
}
