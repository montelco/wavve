<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInBeaconToPassRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('passes', function ($table) {
            $table->unique('uuid');
        });

        Schema::create('beacons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('uuid', 36)->unique()->index();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('pass_beacon', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('beacon_uuid', 36)->index();
            $table->string('passes_uuid', 7)->index();
            $table->timestamps();

            $table->foreign('beacon_uuid')->references('uuid')->on('beacons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pass_beacon');

        Schema::dropIfExists('beacons');

        Schema::table('passes', function ($table) {
            $table->dropUnique('uuid');
        });
    }
}
