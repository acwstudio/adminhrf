<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('title',255)->unique();
            $table->string('slug',100)->unique();
            $table->string('url',100)->unique();
            $table->text('announce')->nullable(false);
            $table->integer('listorder')->default(200);
            $table->text('body')->nullable(false);
            $table->boolean('show_in_rss')->default(false);
            $table->string('yatextid')->nullable();
            $table->boolean('status')->default(true);
            $table->string('image_id')->nullable();
            $table->boolean('show_in_main')->default(true);
            $table->boolean('show_in_afisha')->default(true);
            $table->boolean('close_commentation')->default(false);
            $table->bigInteger('gallery_id')->nullable(false);
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
