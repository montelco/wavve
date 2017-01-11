<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id', 11);
            $table->string('name');
            $table->string('email', 127)->unique();
            $table->string('password');
            $table->enum('subscribed', ['0', '1']);
            $table->string('website', 254)->nullable();
            $table->string('facebook', 254)->nullable();
            $table->string('twitter', 254)->nullable();
            $table->string('instagram', 254)->nullable();
            $table->string('pinterest', 254)->nullable();
            $table->string('description', 254)->nullable();
            $table->string('username', 36)->index();
            $table->string('profile_pic', 128)->index();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
