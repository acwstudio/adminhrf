<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Biography;
use App\Models\Old\Comments as OldComment;
use App\Models\Old\Article as OldArticle;
use App\Models\Comment;
use App\Models\Old\CommentThreads;
use App\Models\Old\Film;
use App\Models\Old\Person;
use App\Models\Old\Stats;

use App\Models\Videomaterial;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ParseViews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:views';

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
        $entitiesMap = [
            'SIP\FilmBundle\Entity\Film' => 'videomaterial',
            'SIP\ArtworkBundle\Entity\Artworks' => 'article',
//            'SIP\EventBundle\Entity\Event' => 'article',
            'SIP\PersonBundle\Entity\Person' => 'biography',
//            'SIP\QuizBundle\Entity\Quiz' => 'test',
        ];

        $this->newLine();
        $this->line('Parsing articles');

        $articles = Article::cursor();

        $bar = $this->output->createProgressBar($articles->count());

        foreach ($articles as $article){
            $oldArticle = OldArticle::find($article->id);
            if(!is_null($oldArticle)) {
                $stat = Stats::where('resource_type', '=', 'SIP\ArtworkBundle\Entity\Artworks')
                    ->where('resource_id', '=', $oldArticle->id)->first();
		$var = json_decode($stat->params);
                $article->viewed = $var->views; // ['views']; // $stat->params->views;
                $article->save;
            }
        }
        $bar->advance();
        $bar->finish();
        $this->newLine();
        $this->info('All articles processed!');

        $bios = Biography::cursor();

        $bar = $this->output->createProgressBar($bios->count());

        foreach ($bios as $bio){
            $person = Person::find($bio->id);
            if(!is_null($person)) {
                $stat = Stats::where('resource_type', '=', 'SIP\PersonBundle\Entity\Person')
                    ->where('resource_id', '=', $person->id)->first();
		$var = json_decode($stat->params);
                $bio->viewed = $var->views; //['views']; // $stat->params->views;
                $bio->save;
            }
        }

        $bar->advance();
        $bar->finish();
        $this->newLine();
        $this->info('All bios processed!');


        $films = Videomaterial::where('type','=','film')->cursor();

        $bar = $this->output->createProgressBar($films->count());

        foreach ($films as $film){
            $oldFilm = Film::find($film->id);
            if(!is_null($person)) {
                $stat = Stats::where('resource_type', '=', 'SIP\FilmBundle\Entity\Film')
                    ->where('resource_id', '=', $oldFilm->id)->first();
		$var = json_decode($stat->params);
                $film->viewed = $var->views; // ['views']; //$stat->params->views;
                $film->save;
            }
        }

        $bar->advance();
        $bar->finish();
        $this->newLine();
        $this->info('All films processed!');


        return 1;
    }
}
