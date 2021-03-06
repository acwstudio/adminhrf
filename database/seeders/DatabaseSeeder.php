<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Like;
use App\Models\News;
use App\Models\Tag;
use App\Models\User;
use App\Models\View;
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
#         \App\Models\User::factory(10)->create();


        //Generate some articles
//        User::factory(10)->create();
#        Tag::factory(10)->create();
//        Article::factory(10)->create()->each( function($article){
//            $randTag = Tag::all()->random(rand(0,2))->pluck('id');
//            $article->tags()->attach($randTag);
//        });

#        News::factory(20)->create()->each( function($news){
#            $randTag = Tag::all()->random(rand(0,2))->pluck('id');
#            $news->tags()->attach($randTag);
#        });
        Comment::factory()->count(100)->create();

//        View::factory()->count(1)->create();
//       # Like::factory(10)->create();
//        Comment::factory(10)->create();
        //Database::unprepared(file_get_contents(__dir__.'/imports/dumps/dbhistory_public_qcategories'))

    }
}
