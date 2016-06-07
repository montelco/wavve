<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixPassesPublishingDefault extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::table('passes', function($table){
        //    $table->enum('published', ['0', '1'])->default('0');
        //});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::table('passes', function($table){
        //    $table->dropColumn('published');
        //});
    }
}
