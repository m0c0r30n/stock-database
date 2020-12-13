<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lionnotes', function (Blueprint $table) {
            $table->dropColumn('topfifteen_id');
            $table->dropColumn('lion_note');
            $table->string('stock_name');
            $table->bigInteger('stock_number');
            $table->text('description');
            $table->string('dekidaka')->nullable();
            $table->string('over_under')->nullable();
            $table->bigInteger('stock_ranking')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lionnotes', function (Blueprint $table) {
            //
        });
    }
}
