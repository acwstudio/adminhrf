<?php

namespace App\Console\Commands;

use App\Models\Tag;
use App\Models\Taggable;
use Illuminate\Console\Command;

class CountTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'count:tags';

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
        $tags = Tag::cursor();
        $bar = $this->output->createProgressBar($tags->count());
        $bar->start();
        foreach ($tags as $tag) {
            $tag->count =  Taggable::where('tag_id','=',$tag->id)->count();
            $tag->save();
            $bar->advance();

        }
        $bar->finish();
        return 0;
    }
}
