<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->bigInteger('viewed')->default(0);
            $table->bigInteger('liked')->default(0);
            $table->bigInteger('commented')->default(0);
            $table->json('biblio')->nullable();
            $table->date('event_date')->nullable();
            $table->date('event_start_date')->nullable();
            $table->date('event_end_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn([
                'viewed',
                'liked',
                'commented',
                'biblio',
                'event_date',
                'event_start_date',
                'event_end_date'
            ]);
        });
    }
}
