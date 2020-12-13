<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDekidakaAndOu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stockinfos', function (Blueprint $table) {
            $table->string('dekidaka');
            $table->string('overunder');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stockinfos', function (Blueprint $table) {
            $table->dropColumn('dekidaka');
            $table->dropColumn('overunder');
        });
    }
}
