<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDayInHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days_in_history', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title',200);
            $table->string('slug',200);
            $table->smallInteger('day');
            $table->smallInteger('month');
            $table->string('url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('days_in_history');
    }
}
