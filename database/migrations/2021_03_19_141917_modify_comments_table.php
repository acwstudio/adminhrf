<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('parents');
            $table->foreignId('parent_id')->nullable();
            $table->json('answer_to')->nullable();
            $table->bigInteger('liked')->default(0);
            $table->bigInteger('children_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->string('parents');
            $table->dropColumn(['parent_id', 'answer_to', 'liked', 'children_count']);
        });
    }
}
