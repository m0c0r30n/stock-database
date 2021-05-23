<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketInformationssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_informations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('stock_number');
            $table->date('date');
            $table->string('kaitennissu')->nullable();
            $table->string('pastprice')->nullable();
            $table->string('openprice')->nullable();
            $table->string('endprice')->nullable();
            $table->string('highprice')->nullable();
            $table->string('lowprice')->nullable();
            $table->string('tradingprice')->nullable();
            $table->string('increase_rate')->nullable();
            $table->text('onemin_chart')->nullable();
            $table->string('yuusizan_sokuho')->nullable();
            $table->string('kasikabuzan_sokuho')->nullable();
            $table->string('yuusizan_kakuho')->nullable();
            $table->string('kasikabuzan_kakuho')->nullable();
            $table->string('yoriita_over')->nullable();
            $table->string('yoriita_under')->nullable();
            $table->string('nokoriita_over')->nullable();
            $table->string('nokoriita_under')->nullable();
            $table->string('dekidaka')->nullable();
            $table->string('vwap')->nullable();
            $table->string('tick')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('market_informations');
    }
}
