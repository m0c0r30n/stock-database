<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewnotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviewnotes', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('heatmap_before');
            $table->string('heatmap_after1');
            
            $table->string('stock1_daylychart');
            $table->string('stock1_daychart');
            $table->string('stock1_extension');
            $table->string('stock1_review');

            $table->string('stock2_daylychart');
            $table->string('stock2_daychart');
            $table->string('stock2_extension');
            $table->string('stock2_review');

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
        Schema::dropIfExists('reviewnotes');
    }
}
