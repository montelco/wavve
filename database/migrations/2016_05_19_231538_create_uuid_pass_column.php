<?php

use Illuminate\Database\Migrations\Migration;

class CreateUuidPassColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('passes', function($table){
        //     $table->string('uuid', 16)->unique();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('passes', function ($table) {
            $table->dropColumn('uuid');
        });
    }
}
