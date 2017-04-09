<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePassBarcodeValueToOfferCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('passes',  function (Blueprint $table) {
            $table->dropColumn('barcode_value');
            $table->string('offer_code', 20)->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('passes', function (Blueprint $table) {
            $table->dropColumn('offer_code');
            $table->integer('barcode_value')->nullable();
        });
    }
}
