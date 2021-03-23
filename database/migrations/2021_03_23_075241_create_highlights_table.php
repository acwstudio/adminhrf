<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHighlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('highlights', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title',200);
            $table->string('type',20);
            $table->string('announce',550)->nullable();
            $table->integer('order')->nullable();
            $table->string('slug',200)->unique();
            $table->timestamp('published_at')->default(now());
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('highlights');
    }
}
