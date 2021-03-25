<?php

namespace App\Console\Commands;

use App\Models\Highlight;
use App\Models\Old\Audiocourse;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ParseAudiocourses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:audiocourses {--T|truncate : Clear audiocourses table before parse}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse of audio content';

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
        $this->info('Start parsing audiocourses...');

        if ($truncate) {
            $this->line('Clearing table');

            $this->withProgressBar(Audiocourse::all(), function ($audiocourse) {
                $audiocourse->authors()->detach();

            });

            Audiocourse::truncate();
        }

        $this->newLine();
        $this->line('Parsing audiocourses');

        $oldaudiocourses = Audiocourse::cursor();

        $bar = $this->output->createProgressBar($oldaudiocourses->count());

        $bar->start();

        foreach ($oldaudiocourses as $oldaudiocourse) {

            if (!$truncate) {
                $audiocourse = Audiocourse::find($oldaudiocourse->id);
            }

            if (!is_null($audiocourse)) {
                Highlight::create(
                    [
                        'id' => $oldaudiocourse->id,
                        'title' => is_null($oldaudiocourse->parent_id)?
                            $oldaudiocourse->title:audiocourse::where('id',$oldaudiocourse->parent_id)->firstOrFail()->title.'. '.$oldaudiocourse->title,
                        'announce' => $oldaudiocourse->description,
                        'order' => $oldaudiocourse->position,
                        'active' => true,
                        'updated_at' => now(),
                        'created_at' => now(),
                        'published_at' => now(),
                        'type' => 'audiocourse',
                    ]
                );
            }

            $bar->advance();
        }

        $bar->finish();

        DB::unprepared("SELECT SETVAL('highlights_id_seq', (SELECT MAX(id) + 1 FROM highlights))");

        $this->newLine();
        $this->info('All audiocourses processed!');

        return 1;
    }
}
