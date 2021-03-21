<?php

namespace App\Console\Commands;

use App\Models\Film;
use App\Models\Old\Film as OldFilm;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ParseFilms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:films  {--T|truncate : Clear films table before parse}';

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
        $this->info('Start parsing Films...');

        if ($truncate) {
            $this->line('Clearing table');

            $this->withProgressBar(Film::all(), function ($Film) {
                $Film->authors()->detach();

            });

            Film::truncate();
        }

        $this->newLine();
        $this->line('Parsing Films');

        $oldFilms = OldFilm::cursor();

        $bar = $this->output->createProgressBar($oldFilms->count());

        $bar->start();

        foreach ($oldFilms as $oldFilm) {

            if (!$truncate) {
                $Film = Film::find($oldFilm->id);
            }

            if (($truncate || is_null($Film))&&!is_null($oldFilm->video_code)) {
                $Film = Film::create(
                    [
                        'id' => $oldFilm->id,
                        'user_id' => $oldFilm->director_id,
                        'title' => $oldFilm->title,
                        'slug' => $oldFilm->slug,
                        'announce' => $oldFilm->announce,
                        'body' => $oldFilm->body,
                        'video_code' => $oldFilm->video_code,
                        'created_at' => $oldFilm->date,
                        'updated_at' => $oldFilm->updatedat,
                        'published_at' => $oldFilm->updatedat,
                        'show_in_main' =>$oldFilm->showinmain,
                        'show_in_rss' => $oldFilm->show_in_rss,
                    ]
                );

                $authors = $oldFilm->authors()->where('stream_id', 16)->get()->pluck('id');

                $Film->authors()->attach($authors);
            }

            $bar->advance();
        }

        $bar->finish();

        DB::unprepared("SELECT SETVAL('Films_id_seq', (SELECT MAX(id) + 1 FROM Films))");

        $this->newLine();
        $this->info('All Films processed!');

        return 1;
    }

}
