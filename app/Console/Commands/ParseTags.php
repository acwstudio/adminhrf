<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Old\Tag as OldTag;
use App\Models\Old\Tagging;
use App\Models\Tag;
use App\Models\Videomaterial;
use Illuminate\Console\Command;

class ParseTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:tags {--T|truncate : Clear tags table before parse}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse tags';

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
            'videomaterial' => 'SIP\FilmBundle\Entity\Film',
            'article' => 'SIP\ArtworkBundle\Entity\Artworks',
//            'SIP\EventBundle\Entity\Event' => 'article',
            'biography' => 'SIP\PersonBundle\Entity\Person',
//            'SIP\QuizBundle\Entity\Quiz' => 'test',
        ];
        $truncate = $this->option('truncate');

        $this->newLine();
        $this->line('Parsing tags');

        $tags = OldTag::cursor();



        if ($truncate) {
            $this->line('Clearing table');

            OldTag::truncate();
        }
        $bar = $this->output->createProgressBar($tags->count());

        foreach ($tags as $tag){
            if(!is_null($tag)){
                $newTag = Tag::create([
                    'id' => $tag->id,
                    'slug' => $tag->slug,
                    'title' => $tag->name,
                    'created_at' => $tag->created_at,
                    'updated_at' => $tag->updated_at,
                ]);
            }
            $relations=Tagging::where('tag_id',$newTag->id)->where('resource_type','=',$entitiesMap['article']);
            foreach($relations as $relation){
                $article = Article::where('id',$relation->resource_id);
                if(!is_null($article)){
                    $newTag->articles()->save($article);
                }
            }
            $relations=Tagging::where('tag_id',$newTag->id)->where('resource_type','=',$entitiesMap['videomaterial']);
            foreach($relations as $relation){
                $film = Videomaterial::where('id',$relation->resource_id);
                if(!is_null($film)){
                    $newTag->videomaterials()->save($film);
                }
            }
        }



    }
}
