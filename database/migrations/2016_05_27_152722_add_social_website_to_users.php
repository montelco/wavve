<?php

use Illuminate\Database\Migrations\Migration;

class AddSocialWebsiteToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('website', 254)->nullable();
            $table->string('facebook', 254)->nullable();
            $table->string('twitter', 254)->nullable();
            $table->string('instagram', 254)->nullable();
            $table->string('pinterest', 254)->nullable();
            $table->string('description', 254)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('website');
            $table->dropColumn('facebook');
            $table->dropColumn('twitter');
            $table->dropColumn('instagram');
            $table->dropColumn('pinterest');
            $table->dropColumn('description');
        });
    }
}
