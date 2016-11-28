<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmojiSupportOnPassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('passes', function ($table) {
            DB::statement('ALTER TABLE `passes` CHANGE `title` `title` VARCHAR(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL, CHANGE `primary_field` `primary_field` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL, CHANGE `secondary_field` `secondary_field` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('passes', function ($table) {
            DB::statement('ALTER TABLE `passes` CHANGE `title` `title` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, CHANGE `primary_field` `primary_field` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, CHANGE `secondary_field` `secondary_field` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL');
        });
    }
}
