<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopfifteensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topfifteens', function (Blueprint $table) {
            $table->id();
            $table->string('cover');
            $table->string('stockname1');
            $table->string('stockname2');
            $table->string('stockname3');
            $table->string('stockname4');
            $table->string('stockname5');
            $table->string('stockname6');
            $table->string('stockname7');
            $table->string('stockname8');
            $table->string('stockname9');
            $table->string('stockname10');
            $table->string('stockname11');
            $table->string('stockname12');
            $table->string('stockname13');
            $table->string('stockname14');
            $table->string('stockname15');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topfifteens');
    }
}
