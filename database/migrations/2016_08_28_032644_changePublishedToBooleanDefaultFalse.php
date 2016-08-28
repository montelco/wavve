<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePublishedToBooleanDefaultFalse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('passes', function ($table) {
            $table->dropColumn('published');
        });
        
        Schema::table('passes', function ($table) {
            $table->boolean('published')->default(false);
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
            $table->dropColumn('published');
        });

        Schema::table('passes', function ($table) {
            $table->timestamp('published')->default(DB::raw('CURRENT_TIMESTAMP'))->after('template');
        });
    }
}
