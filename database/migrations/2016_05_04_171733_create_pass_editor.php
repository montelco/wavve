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
        Schema::create('passes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->string('uuid', 7)->unique();
            $table->string('header_foreground_image', 254)->nullable();
            $table->string('header_background_image', 254)->nullable();
            $table->string('title', 64);
            $table->string('theme', 1);
            $table->enum('template_number', ['1', '2', '3']);
            $table->timestamp('expiry')->nullable();
            $table->boolean('published')->default(false);
            $table->string('strip_background_image', 254)->nullable();
            $table->text('primary_field', 500);
            $table->text('secondary_field', 500)->nullable();
            $table->string('coupon_full_background_image', 254)->nullable();
            $table->integer('barcode_value')->nullable();
            $table->string('cashier_helper', 64)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::table('passes', function (Blueprint $table) {
            DB::statement('ALTER TABLE `passes` CHANGE `uuid` `uuid` VARCHAR(16) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL');
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
