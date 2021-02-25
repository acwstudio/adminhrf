<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_answers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('result_id');
            $table->integer('question_id');
            $table->boolean('is_right');

            $table->foreign('result_id')->references('id')->on('tresults')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('question_id')->references('id')->on('questions')->cascadeOnDelete()->cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('result_answers');
    }
}
