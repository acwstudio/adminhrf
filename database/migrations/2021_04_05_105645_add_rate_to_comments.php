<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRateToComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('liked');
            $table->bigInteger('rate')->default(0);
            $table->string('type')->default('comment');
            $table->string('estimate')->nullable()->default(null);
        });

        \App\Models\Like::where('likeable_type', 'comment')->delete();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->bigInteger('liked')->default(0);
            $table->dropColumn(['rate', 'type', 'estimate']);
        });
    }
}
