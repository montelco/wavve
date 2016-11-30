<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixLongitudeValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beacons', function ($table) {
            $table->dropColumn('lon');
        });

        Schema::table('beacons', function ($table) {
            $table->double('lon', 10, 6)->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beacons', function ($table) {
            $table->dropColumn('lon');
        });

        Schema::table('beacons', function ($table) {
            $table->double('lon', 10, 6)->unsigned()->index();
        });
    }
}
