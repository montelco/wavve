<?php

use Illuminate\Database\Migrations\Migration;

class AddStatsForeignKeyForPasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('stats', function($table){
        //     $table->bigInteger('passes_id')->unsigned();
        //     $table->foreign('passes_id')->references('id')->on('passes')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
