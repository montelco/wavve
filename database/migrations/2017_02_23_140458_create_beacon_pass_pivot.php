<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeaconPassPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beacon_pass', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('pass_id')->unsigned();
            $table->uuid('beacon_uuid');
            $table->timestamps();

            $table->foreign('beacon_uuid')->references('uuid')->on('beacons')->onDelete('cascade');
            $table->foreign('pass_id')->references('id')->on('passes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beacon_pass');
    }
}
