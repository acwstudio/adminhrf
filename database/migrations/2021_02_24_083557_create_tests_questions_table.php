<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests_question', function (Blueprint $table) {
            $table->integer('test_id');
            $table->integer('question_id');

            $table->foreign('test_id')->references('id')->on('tests')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::table('tests_question', function (Blueprint $table) {
            Schema::dropIfExists('tests_question');
        });
    }
}
