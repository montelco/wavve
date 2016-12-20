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
        Schema::create('beacons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->uuid('uuid')->unique();
            $table->macAddress('hardware_address');
            $table->double('lon', 10, 6)->index();
            $table->double('lat', 10, 6)->unsigned()->index();
            $table->string('nickname', 32);
            $table->string('software', 18);
            $table->string('hardware', 16);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('user_beacon', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('beacon_uuid', 36)->index();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('user_beacon');

        Schema::dropIfExists('beacons');
    }
}
