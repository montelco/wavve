<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePublishEnumToTimestamp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('passes', function($table){
            $table->dropColumn('published');
        });

        Schema::table('passes', function($table){
            $table->timestamp('published')->default(DB::raw('CURRENT_TIMESTAMP'))->after('template');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('passes', function($table){
            $table->dropColumn('published')->default(DB::raw('CURRENT_TIMESTAMP'))->after('template');
            $table->enum('published', ['0', '1'])->default('0php ');
        });
    }
}
