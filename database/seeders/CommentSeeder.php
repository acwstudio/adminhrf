<?php

namespace Database\Seeders;

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

        DB::table('comments')->insert([
            'user_id' => 1,
            'text' => 'cdvfg cbfvg vbgngh',
            'commentable_id' => 2,
            'commentable_type' => 'article',
            'liked' => 3,
            'children_count' => 3

        ]);
    }
}
