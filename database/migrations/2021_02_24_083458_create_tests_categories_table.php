<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests_categories', function (Blueprint $table) {
            $table->integer('test_id');
            $table->integer('category_id');
            $table->foreign('test_id')->references('id')->on('tests')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('qcategories')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests_categories');
    }
}
