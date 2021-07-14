<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKessanyoteisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kessanyoteis', function (Blueprint $table) {
            $table->date('happyo_date');
            $table->bigInteger('stock_number');
            $table->string('name');
            $table->string('gyoshu');
            $table->string('quarter');
            $table->string('market');

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
        Schema::dropIfExists('kessanyoteis');
    }
}
