<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Author;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = Article::all();
        $authors = Author::all();

        $limitArticles = 30 - $articles->count();
        $limitAuthors = 20 - $authors->count();

        if ($limitArticles > 0) {
            Article::factory()->count($limitArticles)->create();
            $this->command->newLine();
            $this->command->info('It has created ' . $articles->count() . ' lines', 'info');
            $this->command->newLine();
        } else {
            $this->command->warn('You have already ' . $articles->count() . ' lines, table will be re-created', 'warn');
            if ($this->command->confirm('Do you wish to continue?')) {
                DB::table('articles')->truncate();
                $this->command->info('Your table was re-created');
                $this->command->newLine();
            }
        }

        if ($limitAuthors === 0) {

            $this->authorRelations($articles, $authors);

        } else {

            $this->call([
                AuthorSeeder::class
            ]);
            $this->command->warn('Repeat call ArticleSeeder', 'warn');
            //$this->authorRelations($articles, $authors);
        }
    }

    /**
     * @param Article|Collection $articles
     * @param Author|Collection $authors
     */
    private function authorRelations($articles, $authors)
    {
        DB::table('author_article')->truncate();

        foreach ($articles as $item) {
            $amountAuthors = [1, 2, 3];
            $option = array_rand($amountAuthors);
            $ids = $authors->random($amountAuthors[$option])->pluck('id');
            $item->authors()->attach($ids);
        }
    }
}
