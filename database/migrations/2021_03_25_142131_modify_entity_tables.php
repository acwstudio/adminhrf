<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyEntityTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('biographies', function(Blueprint $table){
            $table->integer('commented')->default(0);
            $table->integer('liked')->default(0);
        });
        Schema::table('videomaterials', function(Blueprint $table){
            $table->integer('commented')->default(0);
            $table->integer('liked')->default(0);
        });
        Schema::table('documents', function(Blueprint $table){
            $table->integer('liked')->default(0);
        });
        Schema::table('highlights', function(Blueprint $table){
            $table->integer('commented')->default(0);
            $table->integer('liked')->default(0);
        });
        Schema::table('events', function(Blueprint $table){
            $table->integer('commented')->default(0);
            $table->integer('liked')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('biographies', function(Blueprint $table){
            $table->dropColumn('commented');
            $table->dropColumn('liked');
        });
        Schema::table('videomaterials', function(Blueprint $table){
            $table->dropColumn('commented');
            $table->dropColumn('liked');
        });
        Schema::table('documents', function(Blueprint $table){
            $table->dropColumn('liked');
        });
        Schema::table('highlights', function(Blueprint $table){
            $table->dropColumn('commented');
            $table->dropColumn('liked');
        });
        Schema::table('events', function(Blueprint $table){
            $table->dropColumn('commented');
            $table->dropColumn('liked');
        });
    }
}
