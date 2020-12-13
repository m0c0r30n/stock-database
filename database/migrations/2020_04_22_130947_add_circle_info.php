<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCircleInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('circles', function (Blueprint $table) {
            $table->string('web_url');
            $table->string('activity_day');
            $table->string('activity_place');
            $table->string('account_people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('circles', function (Blueprint $table) {
            $table->dropColumn('web_url');
            $table->dropColumn('activity_day');
            $table->dropColumn('activity_place');
            $table->dropColumn('account_people');
        });
    }
}
