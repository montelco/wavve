<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTemplateNumberToJustTemplate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('passes', function($table){
            DB::statement("ALTER TABLE `passes` CHANGE COLUMN `template` `template_number`");
        });
    }

    public function down()
    {
        // There is no down as this is a hotfix to resolve a naming issue across most versions.
    }
}
