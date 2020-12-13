<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSikihoDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sikiho_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('stockdata_id');
            $table->string('sikiho_title');
            $table->bigInteger('sikiho_year_season');
            $table->text('characteristic');
            $table->text('perspective');
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
        Schema::dropIfExists('sikiho_data');
    }
}
