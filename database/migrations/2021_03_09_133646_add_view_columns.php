<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddViewColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->bigInteger('viewed')->default(0);
        });

        Schema::table('biographies', function (Blueprint $table) {
            $table->bigInteger('viewed')->default(0);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('viewed');
        });

        Schema::table('biographies', function (Blueprint $table) {
            $table->dropColumn('viewed');
        });
    }
}
