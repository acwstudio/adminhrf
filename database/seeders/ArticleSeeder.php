<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Author;
use App\Models\Image;
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
        $images = Image::all();
        dd($articles);
        $limitArticles = 30 - $articles->count();
        $limitAuthors = 20 - $authors->count();
        $limitImages = 30 - $images->count();

        if ($limitArticles > 0) {
            Article::factory()->count($limitArticles)->create();
            $this->command->newLine();
            $this->command->info('It has created ' . $articles->count() . ' lines', 'info');
            $this->command->newLine();
        } else {
            $this->command->warn('You have already ' . $articles->count() . ' lines, table will be re-created', 'warn');
            if ($this->command->confirm('Do you wish to continue?')) {
                DB::table('articles')->truncate();
                $this->command->info('Your table was truncated');
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
        }
//
//        if ($limitImages === 0) {
//
//            $this->authorRelations($articles, $images);
//
//        } else {
//
//            $this->call([
//                ImageSeeder::class
//            ]);
//
//            $this->command->warn('Repeat call ImageSeeder', 'warn');
//        }
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

    /**
     * @param Article|Collection $articles
     * @param Image|Collection $images
     */
//    private function imageRelations($articles, $images)
//    {
//        DB::table('images')->truncate();

        /** @var Article $item */
//        foreach ($articles as $item) {
//            $amountImages = [1, 2, 3];
//            $option = array_rand($amountImages);
//            $ids = $images->random($amountImages[$option])->pluck('id');
//            $item->images()->asso($ids);
//            $item->images()->associate()
//        }
//    }
}
