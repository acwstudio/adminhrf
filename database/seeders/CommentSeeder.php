<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class CommentSeeder
 * @package Database\Seeders
 */
class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $comment = Comment::factory()->count(1)->create([
            'user_id' => 1,
            'commentable_id' => 5,
            'commentable_type' => 'biography',
            'answer_to' => null,
            'liked' => 6,
            'children_count' => 0
        ]);
//        DB::table('comments')->insert([
//            'user_id' => 1,
//            'text' => 'cdvfg cbfvg vbgngh',
//            'commentable_id' => 2,
//            'commentable_type' => 'article',
//            'liked' => 3,
//            'children_count' => 3
//
//        ]);
    }
}
