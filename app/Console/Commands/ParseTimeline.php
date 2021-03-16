<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Biography;
use App\Models\Old\Event;
use App\Models\Timeline;
use Illuminate\Console\Command;
use App\Models\Old\Article as OldArticle;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ParseTimeline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:timeline';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse events data from articles';

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

        $events = Article::where('event_date','>',Carbon::parse(('0001/01/01'))->format('Y-m-d'),)->cursor();

        $bar = $this->output->createProgressBar($events->count());

        $bar->start();

        foreach ($events as $event) {

            if($event->start_date==''){

                $article = Timeline::create(
                    [
                        'timelinable_id' => $event->id,
                        'timelinable_type' => 'article',
                        'date' => $event->event_date,
                    ]
                );

                $bar->advance();
            }

        }

        $bar->finish();
        $this->newLine();
        $this->info('All events processed!');

        $this->newLine();
        $this->line('Parsing events');
        $biographies = Biography::where('birth_date', '>',Carbon::parse(('0001/01/01'))->format('Y-m-d') )->cursor();
        $bar = $this->output->createProgressBar($biographies->count());

        foreach ($biographies as $biography) {

            if($biography->start_date==''){

                $article = Timeline::create(
                    [
                        'timelinable_id' => $biography->id,
                        'timelinable_type' => 'biography',
                        'date' => $biography->birth_date,
                    ]
                );

                $bar->advance();
            }

        }
        $bar->start();


        $bar->finish();
        $this->newLine();
        $this->info('All bios processed!');

        return 1;
    }
}
