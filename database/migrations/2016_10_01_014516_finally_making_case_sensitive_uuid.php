<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FinallyMakingCaseSensitiveUuid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('passes', function ($table) {
            DB::statement('ALTER TABLE `passes` DROP INDEX `passes_uuid_unique`');
            DB::statement('ALTER TABLE `passes` CHANGE `uuid` `uuid` VARCHAR(16) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL');
            $table->unique('uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //We ain't stopping this now!
    }
}
