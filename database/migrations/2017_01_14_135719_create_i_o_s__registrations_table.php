<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIOSRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ios_registrations', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('uuid')->index();
            $table->string('pass_type_id');
            $table->string('push_token', 64)->index();
            $table->string('ios_devices_id', 32)->index();
            $table->string('ios_passes_serial', 127)->index();
            $table->timestamps();
        });

        Schema::table('ios_registrations', function (Blueprint $table) {
            $table->foreign('ios_devices_id')->references('device')->on('ios_devices')->onDelete('cascade');
            $table->foreign('ios_passes_serial')->references('serial_no')->on('ios_passes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('i_o_s__registrations');
    }
}
