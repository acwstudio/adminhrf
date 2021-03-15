<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyBioCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('biography_categories', function(Blueprint $table){
           $table->foreign('biography_id')->references('id')->on('biographies')
                    ->cascadeOnDelete()->cascadeOnUpdate();
           $table->foreign('category_id')->references('id')->on('biocategories')
                  ->cascadeOnDelete()->cascadeOnUpdate();

           $table->unique(['biography_id','category_id']);



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('biography_categories', function(Blueprint $table){
            $table->dropConstrainedForeignId('biography_id');
            $table->dropConstrainedForeignId('category_id');
            $table->dropUnique(['biography_id','category_id']);
        });
    }
}
