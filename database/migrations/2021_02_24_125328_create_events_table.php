<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->text('description');
            $table->text('graph_announce')->nullable();
            $table->text('card_announce')->nullable();
            $table->boolean('is_date_bc')->default(false);
            $table->boolean('show_in_timeline')->default(true);
            $table->boolean('close_commentation')->default(false);
            $table->smallInteger('date_year');
            $table->smallInteger('date_month');
            $table->smallInteger('date_day');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
