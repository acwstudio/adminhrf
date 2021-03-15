<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTanswersColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tanswers', function (Blueprint $table) {
            $table->dropColumn('title');
        });
        Schema::table('tanswers', function (Blueprint $table) {
            $table->string('title',255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tanswers', function (Blueprint $table) {
            $table->string('title',100);
        });

        Schema::table('tanswers', function (Blueprint $table) {
            $table->dropColumn('title');
        });
    }
}
