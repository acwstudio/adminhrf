<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLeisuresAndCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leisures', function (Blueprint $table) {
            $table->integer('count')->default(0);
        });
        Schema::table('cities', function (Blueprint $table) {
            $table->integer('count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leisures', function (Blueprint $table) {
            $table->dropColumn('count');
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('count');
        });
    }
}
