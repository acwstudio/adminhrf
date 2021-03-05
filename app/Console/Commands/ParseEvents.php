<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Old\Event;
use Illuminate\Console\Command;
use App\Models\Old\Article as OldArticle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ParseEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse events data from old DB';

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

        $this->info('Start parsing events...');



        $this->newLine();
        $this->line('Parsing events');

        $events = Event::cursor();

        $bar = $this->output->createProgressBar($events->count());

        $bar->start();

        foreach ($events as $event) {


            $endDate = $event->start_date == $event->end_date ? null : $event->end_date;
            $startDate = $event->startdatebc ? $event->start_date->year('-' . $event->start_date->year) : $event->start_date;


            $article = Article::create(
                [
                    'user_id' => null,
                    'title' => $event->title,
                    'slug' => Str::of($event->slug)->append('-event'),
                    'announce' => $event->tape_time_announce,
                    'body' => $event->description,
                    'show_in_rss' => false,
                    'yatextid' => null,
                    'created_at' => $event->updatedat,
                    'updated_at' => $event->updatedat,
                    'published_at' => $event->updatedat,
                    'biblio' => unserialize($event->biblio),
                    'event_date' => $startDate,
                    'event_start_date' => $startDate,
                    'event_end_date' => $endDate
                ]
            );

            $bar->advance();
        }

        $bar->finish();

        DB::unprepared("SELECT SETVAL('articles_id_seq', (SELECT MAX(id) + 1 FROM articles))");

        $this->newLine();
        $this->info('All events processed!');

        return 1;
    }
}
