<?php

use Illuminate\Database\Migrations\Migration;

class HotfixForeignKeyConstraint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visitors', function ($table) {
            $table->dropForeign('visitors_passes_uuid_foreign');
            $table->foreign('passes_uuid')->references('uuid')->on('passes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // No going back now!
    }
}
