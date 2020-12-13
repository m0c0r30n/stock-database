<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnotherstocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topfifteens', function (Blueprint $table) {
            $table->string('stockname16')->nullable();
            $table->string('stockname17')->nullable();
            $table->string('stockname18')->nullable();
            $table->string('stockname19')->nullable();
            $table->string('stockname20')->nullable();
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
            $table->dropColumn('stockname16');
            $table->dropColumn('stockname17');
            $table->dropColumn('stockname18');
            $table->dropColumn('stockname19');
            $table->dropColumn('stockname20');
        });
    }
}
