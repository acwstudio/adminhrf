<?php

namespace App\Console\Commands;

use App\Models\Old\ArticleCategory as OldCategory;
use App\Models\Question;
use App\Models\TAnswer;
use App\Models\Test;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ParseCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:article_categories';

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
        $this->info('Start parsing tests...');



        $this->newLine();
        $this->line('Parsing events');

        $categories = OldCategory::cursor();
        $bar = $this->output->createProgressBar($categories->count());
        $bar->start();
        foreach ($categories as $category){
            $articles = $category->articles;
            foreach ($articles as $article){
                $article->category_id=$category->id;
            }
            $bar->advance();
        }

        $bar->finish();






        return 0;
    }
}
