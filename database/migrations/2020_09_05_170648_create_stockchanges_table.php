<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockchanges', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('reviewnote_id');
            $table->string('stock1')->nullable();
            $table->string('stock2')->nullable();
            $table->string('stock3')->nullable();
            $table->string('stock4')->nullable();
            $table->string('stock5')->nullable();
            $table->string('stock6')->nullable();
            $table->string('stock7')->nullable();
            $table->string('stock8')->nullable();
            $table->string('stock9')->nullable();
            $table->string('stock10')->nullable();
            $table->string('stock11')->nullable();
            $table->string('stock12')->nullable();
            $table->string('stock13')->nullable();
            $table->string('stock14')->nullable();
            $table->string('stock15')->nullable();
            $table->string('stock16')->nullable();
            $table->string('stock17')->nullable();
            $table->string('stock18')->nullable();
            $table->string('stock19')->nullable();
            $table->string('stock20')->nullable();
            $table->string('stock21')->nullable();
            $table->string('stock22')->nullable();
            $table->string('stock23')->nullable();
            $table->string('stock24')->nullable();
            $table->string('stock25')->nullable();
            $table->string('stock1_description')->nullable();
            $table->string('stock2_description')->nullable();
            $table->string('stock3_description')->nullable();
            $table->string('stock4_description')->nullable();
            $table->string('stock5_description')->nullable();
            $table->string('stock6_description')->nullable();
            $table->string('stock7_description')->nullable();
            $table->string('stock8_description')->nullable();
            $table->string('stock9_description')->nullable();
            $table->string('stock10_description')->nullable();
            $table->string('stock11_description')->nullable();
            $table->string('stock12_description')->nullable();
            $table->string('stock13_description')->nullable();
            $table->string('stock14_description')->nullable();
            $table->string('stock15_description')->nullable();
            $table->string('stock16_description')->nullable();
            $table->string('stock17_description')->nullable();
            $table->string('stock18_description')->nullable();
            $table->string('stock19_description')->nullable();
            $table->string('stock20_description')->nullable();
            $table->string('stock21_description')->nullable();
            $table->string('stock22_description')->nullable();
            $table->string('stock23_description')->nullable();
            $table->string('stock24_description')->nullable();
            $table->string('stock25_description')->nullable();
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
        Schema::dropIfExists('stockchanges');
    }
}
