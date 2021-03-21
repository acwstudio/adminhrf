<?php

namespace App\Console\Commands;

use App\Models\VideoLecture;
use App\Models\Old\VideoLecture as OldVideoLecture;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ParseVideoLectures extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:videolecture  {--T|truncate : Clear VideoLectures table before parse}';

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
    public function handle(): int
    {
        $truncate = $this->option('truncate');
        $this->info('Start parsing VideoLectures...');

        if ($truncate) {
            $this->line('Clearing table');

            $this->withProgressBar(VideoLecture::all(), function ($VideoLecture) {
                $VideoLecture->authors()->detach();

            });

            VideoLecture::truncate();
        }

        $this->newLine();
        $this->line('Parsing VideoLectures');

        $oldVideoLectures = OldVideoLecture::cursor();

        $bar = $this->output->createProgressBar($oldVideoLectures->count());

        $bar->start();

        foreach ($oldVideoLectures as $oldVideoLecture) {

            if (!$truncate) {
                $VideoLecture = VideoLecture::find($oldVideoLecture->id);
            }

            if (($truncate || is_null($VideoLecture))&&!is_null($oldVideoLecture->video_code)) {
                $VideoLecture = VideoLecture::create(
                    [
                        'id' => $oldVideoLecture->id,
                        'user_id' => $oldVideoLecture->director_id,
                        'title' => $oldVideoLecture->title,
                        'slug' => $oldVideoLecture->slug,
                        'announce' => $oldVideoLecture->announce,
                        'body' => $oldVideoLecture->body,
                        'video_code' => $oldVideoLecture->video_code,
                        'created_at' => $oldVideoLecture->date,
                        'updated_at' => $oldVideoLecture->updatedat,
                        'published_at' => $oldVideoLecture->updatedat,
                        'show_in_rss' => $oldVideoLecture->show_in_rss,
                    ]
                );

                $authors = $oldVideoLecture->authors()->lecturer_id;

                $VideoLecture->authors()->attach($authors);
            }

            $bar->advance();
        }

        $bar->finish();

        DB::unprepared("SELECT SETVAL('VideoLectures_id_seq', (SELECT MAX(id) + 1 FROM VideoLectures))");

        $this->newLine();
        $this->info('All VideoLectures processed!');

        return 1;
    }
}
