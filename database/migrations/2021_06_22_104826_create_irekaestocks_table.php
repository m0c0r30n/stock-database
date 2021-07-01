<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIrekaestocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irekaestocks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('irekaekensho_id');
            $table->bigInteger('stock_number')->nullable();
            $table->string('irekae_before')->nullable();
            $table->string('irekae_after')->nullable();
            $table->text('info')->nullable();
            $table->text('result')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('irekaestocks');
    }
}
