<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Services\ImageService;
use Illuminate\Console\Command;
use App\Models\Old\Article as OldArticle;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ParseArticlesAnounce extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:articles-announce';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse articles announce';


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

        $this->info('Start parsing articles announce...');

        $this->newLine();

        $articles = Article::whereNull('announce')->get();

        $bar = $this->output->createProgressBar($articles->count());

        $bar->start();

        foreach ($articles as $article) {

            $article->announce = '<p>'.Str::words(strip_tags($article->body)).'</p>';
            $article->save();

            $bar->advance();
        }

        $bar->finish();

        $this->newLine();
        $this->info('All articles processed!');

        return 1;
    }
}
