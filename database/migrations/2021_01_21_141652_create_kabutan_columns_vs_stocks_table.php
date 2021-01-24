<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKabutanColumnsVsStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kabutan_columns_vs_stocks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kabutan_column_id');
            $table->bigInteger('stock_number');
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
        Schema::dropIfExists('kabutan_columns_vs_stocks');
    }
}
