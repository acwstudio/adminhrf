<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('body');
            $table->string('title',350);
            $table->timestamp('published_at');
            $table->boolean('close_commentation');
            $table->string('slug',200)->unique();
            $table->string('video_code', 200);
            $table->boolean('show_in_main')->default(true);
            $table->boolean('show_in_rss')->default(false);
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
        Schema::dropIfExists('films');
    }
}
