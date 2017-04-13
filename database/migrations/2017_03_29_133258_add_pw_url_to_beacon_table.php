<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPwUrlToBeaconTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beacons', function (Blueprint $table) {
            $table->string('pw_url', 11)->after('uuid')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beacons', function (Blueprint $table) {
            $table->dropColumn('pw_url');
        });
    }
}
