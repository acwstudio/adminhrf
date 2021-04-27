<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateAudiofilesTable
 */
class CreateAudiofilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audiofiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('audiomaterial_id')->nullable();
            $table->string('path');
            $table->string('name');
            $table->string('ext');
            $table->bigInteger('size');
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
        Schema::dropIfExists('audiofiles');
    }
}
