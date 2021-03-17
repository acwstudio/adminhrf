<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function(Blueprint $table){
            $table->smallInteger('points');
            $table->boolean('has_points')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function(Blueprint $table){
            $table->dropColumn('points');
            $table->dropColumn('has_points');
        });
    }
}
