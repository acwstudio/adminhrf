<?php

namespace App\Console\Commands;

use App\Models\ArticleCategory;
use Illuminate\Console\Command;

class CountCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'count:article_categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle()
    {
        $this->info('Start counting taggables ...');



        $this->newLine();
        $this->line('Parsing taggables count');
        $categories = ArticleCategory::cursor();
        $bar = $this->output->createProgressBar($categories->count());
        $bar->start();
        foreach ($categories as $category) {
            $category->count = $category->articles->count();
            $category->save();
            $bar->advance();
        }
        $bar->finish();
        return 0;
    }
}
