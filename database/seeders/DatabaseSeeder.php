<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\News;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         \App\Models\User::factory(10)->create();


        //Generate some articles
//        User::factory(10)->create();
//        Tag::factory(10)->create();
//        Article::factory(10)->create()->each( function($article){
//            $randTag = Tag::all()->random(rand(0,10))->pluck('id');
//            $randUser=User::all()->random(rand(0,20))->pluck('id');
//            $article->tags()->attach($randTag);
//
//        });
//        Tag::factory(10)->create();

        News::factory(10)->create()->each( function($news){
//
            $randTag = Tag::all()->random(rand(0,3))->pluck('id');
            $news->tags()->attach($randTag);
//
//
        });

//        Comment::factory(10)->create();
        //Database::unprepared(file_get_contents(__dir__.'/imports/dumps/dbhistory_public_qcategories'))

    }
}
