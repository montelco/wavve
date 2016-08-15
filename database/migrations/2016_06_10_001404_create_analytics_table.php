<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalyticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         *  Raw update query to unsign the passes id column. Schema builder, as of Laravel 5.2, cannot make these changes to the DB.
         *  Therefore, the column must be changed using a standard query.
         */
        Schema::table('passes', function ($table) {
            DB::statement('ALTER TABLE `passes` CHANGE COLUMN `id` `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT FIRST');
        });

        Schema::create('stats', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->bigInteger('passes_id')->unsigned();
            $table->time('active_time');
            $table->string('button_clicked')->nullable();
            $table->string('cookie_id', 128);
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
            DB::statement('ALTER TABLE `passes` CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT FIRST');
        });

        Schema::drop('stats');
    }
}
