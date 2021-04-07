<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('link')->default('rvio.histrf.ru');
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->integer('viewed')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('link');
            $table->dropColumn('slug');
            $table->dropColumn('title');
            $table->dropColumn('viewed');
        });
    }
}
