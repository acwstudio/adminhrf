<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tests', function(Blueprint $table){
            $table->smallInteger('total_questions')->default(4);
            $table->smallInteger('max_points')->default(0);
            $table->boolean('has_points')->default(false);
            $table->boolean('is_reversable')->default(false);
            $table->string('description',350)->change();
            $table->boolean('is_ege')->default(false);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tests', function(Blueprint $table){
            $table->dropColumn(['total_questions', 'max_points', 'has_points', 'is_reversable', 'is_ege']);
        });
    }
}
