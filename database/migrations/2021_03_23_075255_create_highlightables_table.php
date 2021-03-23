<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHighlightablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('highlightables', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('event_date');
            $table->integer('highlight_id');
            $table->string('highlightable_type',50);
            $table->integer('highlightable_id');
            $table->integer('order')->nullable();

            $table->unique(['highlight_id','highlightable_type','highlightable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('highlightables');
    }
}
