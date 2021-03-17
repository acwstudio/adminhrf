<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_message', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->smallInteger('lowest_value')->default(0);
            $table->string('text',350);
            $table->smallInteger('highest_value')->default(100);
            $table->string('title',100);
            $table->integer('test_id');

            $table->foreign('test_id')->references('id')->on('tests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_message');
    }
}
