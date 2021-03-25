<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function(Blueprint $table){
            $table->text('body');
            $table->string('announce');
            $table->string('street');
            $table->dateTime('afisha_date');
            $table->timestamp('published_at')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function(Blueprint $table){
            $table->dropColumn('body');
            $table->dropColumn('announce');
            $table->dropColumn('street');
            $table->dropColumn('afisha_date');
            $table->dropColumn('published_at');
        });
    }
}
