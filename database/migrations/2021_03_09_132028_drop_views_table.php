<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('views');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('total');
            $table->timestamps();
            $table->integer('viewable_id');
            $table->string('viewable_type',40);
        });
    }
}
