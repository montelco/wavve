<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePassEditor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passes', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('owner_user_id')->unsigned();
            $table->string('header_foreground_image', 254)->nullable();
            $table->string('header_background_image', 254)->nullable();
            $table->string('title', 64);
            $table->date('expiry')->nullable();
            $table->string('strip_background_image', 254)->nullable();
            $table->text('primary_field', 500);
            $table->text('secondary_field', 500)->nullable();
            $table->string('coupon_full_background_image', 254)->nullable();
            $table->integer('barcode_value');
            $table->string('cashier_helper', 64)->nullable();
            $table->timestamps();

            $table->foreign('owner_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('passes');
    }
}
