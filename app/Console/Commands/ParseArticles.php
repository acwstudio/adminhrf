<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;
use App\Models\Old\Article as OldArticle;
use Illuminate\Support\Facades\DB;

class ParseArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:articles {--T|truncate : Clear articles table before parse}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse articles data from old DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $truncate = $this->option('truncate');
        $this->info('Start parsing articles...');

        if ($truncate) {
            $this->line('Clearing table');

            $this->withProgressBar(Article::all(), function ($article) {
                $article->authors()->detach();
            });

            Article::truncate();
        }

        $this->newLine();
        $this->line('Parsing articles');

        $oldArticles = OldArticle::cursor();

        $bar = $this->output->createProgressBar($oldArticles->count());

        $bar->start();

        foreach ($oldArticles as $oldArticle) {

            if (!$truncate) {
                $article = Article::find($oldArticle->id);
            }

            if ($truncate || is_null($article)) {
                $article = Article::create(
                    [
                        'id' => $oldArticle->id,
                        'user_id' => null,
                        'title' => $oldArticle->title,
                        'slug' => $oldArticle->slug,
                        'announce' => $oldArticle->announce,
                        'body' => $oldArticle->body,
                        'show_in_rss' => $oldArticle->show_in_rss,
                        'yatextid' => $oldArticle->yatextid,
                        'created_at' => $oldArticle->date,
                        'updated_at' => $oldArticle->updatedat,
                        'published_at' => $oldArticle->from_date,
                    ]
                );

                $authors = $oldArticle->authors()->where('stream_id', 16)->get()->pluck('id');

                $article->authors()->attach($authors);
            }

            $bar->advance();
        }

        $bar->finish();

        DB::unprepared("SELECT SETVAL('articles_id_seq', (SELECT MAX(id) + 1 FROM articles))");

        $this->newLine();
        $this->info('All articles processed!');

        return 1;
    }
}
