<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventSchejulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_schejules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('circle_id');
            $table->bigInteger('capacity');
            $table->datetime('open_datetime');
            $table->datetime('close_datetime');
            $table->string('title');
            $table->string('location');
            $table->string('plice');
            $table->text('detail');
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
        Schema::dropIfExists('event_schejules');
    }
}
