<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideomaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videomaterials', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('body')->nullable();
            $table->string('title',500);
            $table->timestamp('published_at')->default(now());
            $table->string('announce',1550)->nullable();
            $table->boolean('close_commentation')->default(false)->nullable();
            $table->string('slug',250)->unique();
            $table->string('video_code', 300);
            $table->boolean('show_in_rss')->default(false)->nullable();
            $table->boolean('show_in_main')->default(true)->nullable();
            $table->boolean('active')->default(true);
            $table->integer('viewed')->default(0);
            $table->string('type')->default('videolecture');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videomaterials');
    }
}
