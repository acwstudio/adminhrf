<?php

namespace App\Console\Commands;

use App\Models\Article as Article;
use App\Models\Old\Tag as OldTag;
use App\Models\Old\Tagging;
use App\Models\Tag;
use App\Models\Taggable;
use App\Models\Videomaterial;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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

        foreach ($tags as $tag) {
            $check = Tag::where('slug', '=', $tag->slug)->first();
            if (!is_null($tag) && is_null($check)) {
                $newTag = Tag::create([
                    'id' => $tag->id,
                    'slug' => $tag->slug,
                    'title' => $tag->name,
                    'created_at' => $tag->created_at,
                    'updated_at' => $tag->updated_at,
                ]);

                $relations = Tagging::where('tag_id', $tag->id)->where('resource_type', '=', $entitiesMap['article'])->get();
                var_dump($newTag->id);
                foreach ($relations as $relation) {
                    $article = Article::where('id', $relation->resource_id);
                    //$exists = Taggable::where('tag_id', $tag->id)->where('taggable_type', '=', 'article')->where('taggable_id', '=', $relation->resource_id)->get();
                    if (!is_null($article)) {
                        DB::unprepared("INSERT INTO taggables(tag_id,taggable_id,taggable_type)
                                values({$tag->id},{$relation->resource_id},'article')");
                    }
                }
                $relations = Tagging::where('tag_id', $tag->id)->where('resource_type', '=', $entitiesMap['videomaterial'])->get();
                foreach ($relations as $relation) {
                    $film = Videomaterial::where('id', $relation->resource_id);
                    if (!is_null($film)) {
                        DB::unprepared("INSERT INTO taggables(tag_id,taggable_id,taggable_type)
                                values({$tag->id},{$relation->resource_id},'videomaterial')");
                    }
                }
            }

        }


    }
}
