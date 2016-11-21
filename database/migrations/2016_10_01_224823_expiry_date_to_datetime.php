<?php

use Illuminate\Database\Migrations\Migration;

class ExpiryDateToDatetime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('passes', function ($table) {
            $table->dropColumn('expiry');
        });

        Schema::table('passes', function ($table) {
            $table->timestamp('expiry')->nullable();
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
            $table->date('expiry')->nullable();
        });
    }
}
