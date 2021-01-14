<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDropTopfifTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topfifteens', function (Blueprint $table) {
            $table->dropColumn('stockname1');
            $table->dropColumn('stockname2');
            $table->dropColumn('stockname3');
            $table->dropColumn('stockname4');
            $table->dropColumn('stockname5');
            $table->dropColumn('stockname6');
            $table->dropColumn('stockname7');
            $table->dropColumn('stockname8');
            $table->dropColumn('stockname9');
            $table->dropColumn('stockname10');
            $table->dropColumn('stockname11');
            $table->dropColumn('stockname12');
            $table->dropColumn('stockname13');
            $table->dropColumn('stockname14');
            $table->dropColumn('stockname15');
            $table->dropColumn('stockname16');
            $table->dropColumn('stockname17');
            $table->dropColumn('stockname18');
            $table->dropColumn('stockname19');
            $table->dropColumn('stockname20');
            $table->dropColumn('stockname21');
            $table->dropColumn('stockname22');
            $table->dropColumn('stockname23');
            $table->dropColumn('stockname24');
            $table->dropColumn('stockname25');
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
            //
        });
    }
}
