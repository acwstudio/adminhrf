<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('videolectures');
        Schema::drop('films');
        Schema::drop('author_videolecture');
        Schema::drop('author_film');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('videolectures', function(Blueprint $table){
            $table->id();
        });
        Schema::create('films', function(Blueprint $table){
            $table->id();
        });
        Schema::create('author_videolecture', function(Blueprint $table){
            $table->id();
        });
        Schema::create('author_film', function(Blueprint $table){
            $table->id();
        });
    }
}
