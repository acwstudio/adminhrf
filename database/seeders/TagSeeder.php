<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::all();

        $limitTags = 30 - $tags->count();

        if ($limitTags > 0) {
            Tag::factory()->count($limitTags)->create();

            $this->command->newLine();
            $this->command->info('It has created ' . $limitTags . ' lines', 'info');
            $this->command->newLine();
            $this->tagRelations();
        } else {
            $this->command->warn('You have already ' . Tag::all()->count() . ' lines, table will be truncated', 'warn');
            if ($this->command->confirm('Do you wish to continue?')) {

                DB::table('tags')->truncate();

                $this->command->info('Your table was truncated');
                $this->command->newLine();
            }
            $this->tagRelations();
        }
    }

    private function tagRelations()
    {
        DB::table('taggables')->truncate();
        $articles = Article::all();

        $tags = Tag::all();

        foreach ($articles as $article) {
//            dd($tags->random()->id);
            $article->tags()->attach([$tags->random()->id]);
        }
    }
}
