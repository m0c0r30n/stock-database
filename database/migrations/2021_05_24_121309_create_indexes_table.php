<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indexes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('stock_number');
            $table->date('date');
            $table->string('currentprice')->nullable();
            $table->string('pastprice')->nullable();
            $table->string('openprice')->nullable();
            $table->string('endprice')->nullable();
            $table->string('highprice')->nullable();
            $table->string('lowprice')->nullable();
            $table->string('increase_rate')->nullable();
            $table->string('dekidaka')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indexes');
    }
}
