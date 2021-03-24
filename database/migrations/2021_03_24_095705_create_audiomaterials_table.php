<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAudiomaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audiomaterials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->default(null);
            $table->string('slug');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('path');
            $table->integer('position')->default(0);
            $table->boolean('show_in_rss_apple')->default(false);
            $table->integer('viewed')->default(0);
            $table->integer('commented')->default(0);
            $table->integer('liked')->default(0);
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
        Schema::dropIfExists('audiomaterials');
    }
}
