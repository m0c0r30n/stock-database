<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTopfifteensColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topfifteens', function (Blueprint $table) {
            $table->string('stockname21')->nullable();
            $table->string('stockname22')->nullable();
            $table->string('stockname23')->nullable();
            $table->string('stockname24')->nullable();
            $table->string('stockname25')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('topfifteens', function (Blueprint $table) {
            $table->dropColumn('stockname21');
            $table->dropColumn('stockname22');
            $table->dropColumn('stockname23');
            $table->dropColumn('stockname24');
            $table->dropColumn('stockname25');
        });
    }
}
