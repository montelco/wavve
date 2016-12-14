<?php

use Illuminate\Database\Migrations\Migration;

class AddNicknameColumnOnBeacons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beacons', function ($table) {
            $table->string('nickname', 32);
            $table->string('software', 18);
            $table->string('hardware', 16);
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
            $table->dropColumn(['nickname', 'software', 'hardware']);
        });
    }
}
