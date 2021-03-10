<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookmarks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();
            $table->integer('group_id');
            $table->string('bookmarkable_type', 35);
            $table->integer('bookmarkable_id');

            $table->unique([ 'bookmarkable_id', 'bookmarkable_type','group_id']);
            $table->foreign('group_id')->references('id')
                ->on('bookmark_groups')->cascadeOnUpdate()->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookmarks');
    }
}
