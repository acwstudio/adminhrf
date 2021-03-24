<?php

namespace App\Console\Commands;

use App\Models\DayInHistory;
use App\Models\Old\DayInHistory as OldDay;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ParseDayInHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:days';

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
        $this->info('Start parsing days...');



        $this->newLine();
        $this->line('Parsing days');

        $days = OldDay::cursor();

        $bar = $this->output->createProgressBar($days->count());

        $bar->start();

        foreach ($days as $day) {


            $endDate = $day->start_date == $day->end_date ? null : $day->end_date;
            $startDate = $day->startdatebc ? $day->start_date->year('-' . $day->start_date->year) : $day->start_date;


            $d = DayInHistory::create(
                [
                    'id' => $d->id,
                    'day' => $d->day,
                    'month' => $d->month,
                    'title' => $d->title,
                    'url' => $d->url,
                ]
            );

            $bar->advance();
        }

        $bar->finish();

        DB::unprepared("SELECT SETVAL('days_in_history_id_seq', (SELECT MAX(id) + 1 FROM days_in_history))");

        $this->newLine();
        $this->info('All days processed!');
        return 1;
    }
}
