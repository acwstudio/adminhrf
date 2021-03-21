<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyFilms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('films', function(Blueprint $table){
           $table->integer('director_id')->nullable();
           $table->string('announce',1550)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('films', function(Blueprint $table){
            $table->dropColumn('director_id');
            $table->dropColumn('announce');
        });
    }
}
