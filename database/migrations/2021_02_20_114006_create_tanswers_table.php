<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanswers', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('question_id');
            $table->string('title',100);
            $table->boolean('is_right');
            $table->string('description');
            $table->timestamps();

            $table->foreign('question_id')->references('id')->
                on('questions')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tanswers');
    }
}

