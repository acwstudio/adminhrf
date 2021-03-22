<?php

namespace App\Console\Commands;

use App\Models\Author;
use App\Models\Old\VideoLecture as OldVideoLecture;
use App\Models\VideoLecture;
use App\Models\Videomaterial;
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

            $this->withProgressBar(Videomaterial::all(), function ($Videomaterial) {
                $Videomaterial->authors()->detach();

            });

            Videomaterial::truncate();
        }

        $this->newLine();
        $this->line('Parsing Films');

        $oldFilms = OldFilm::cursor();

        $bar = $this->output->createProgressBar($oldFilms->count());

        $bar->start();

        foreach ($oldFilms as $oldFilm) {

            if (!$truncate) {
                $Videomaterial = Videomaterial::find($oldFilm->id);
            }

            if (($truncate || is_null($Videomaterial))&&!is_null($oldFilm->video_code)) {
                $Videomaterial = Videomaterial::create(
                    [
                        'id' => $oldFilm->id,
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
                        'type' => 'film'
                    ]
                );

                $authors = $oldFilm->authors()->where('stream_id', 16)->get()->pluck('id');

                Author::firstOrFail()->where('id','=',$authors)->save($Videomaterial);
            }

            $bar->advance();
        }

        $bar->finish();

        DB::unprepared("SELECT SETVAL('Videomaterials_id_seq', (SELECT MAX(id) + 1 FROM Videomaterials))");

        $this->newLine();
        $this->info('All Films processed!');

        $this->newLine();
        $this->line('Parsing Videomaterials');

        $oldVideoLectures = OldVideoLecture::cursor();

        $bar = $this->output->createProgressBar($oldVideoLectures->count());

        $bar->start();
        $val = DB::unprepared('SELECT MAX(id) + 1 FROM Videomaterials');
        foreach ($oldVideoLectures as $oldVideoLecture) {

            if (!$truncate) {
                $Videomaterial = Videomaterial::find($oldVideoLecture->id);
            }

            if (($truncate || is_null($Videomaterial))&&!is_null($oldVideoLecture->video_code)) {
                $Videomaterial = Videomaterial::create(
                    [
                        'id' => $oldFilm->id,
                        'title' => $oldFilm->title,
                        'slug' => $oldFilm->slug,
                        'announce' => $oldFilm->announce,
                        'body' => $oldFilm->body,
                        'video_code' => $oldFilm->video_code,
                        'created_at' => $oldFilm->date,
                        'updated_at' => $oldFilm->updatedat,
                        'published_at' => $oldFilm->updatedat,
                        'show_in_main' =>true,
                        'show_in_rss' => $oldFilm->show_in_rss,
                        'type' => 'lecture'
                    ]
                );

                $author = $oldVideoLecture->lecturer_id;

                Author::firstOrFail()->where('id','=',$author)->save($Videomaterial);
            }

            $bar->advance();
        }

        $bar->finish();

        DB::unprepared("SELECT SETVAL('Videomaterials_id_seq', (SELECT MAX(id) + 1 FROM Videomaterials))");

        $this->newLine();
        $this->info('All Videomaterials processed!');

        return 1;
    }

}
