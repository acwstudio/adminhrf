<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Services\ImageService;
use Illuminate\Console\Command;
use App\Models\Old\Article as OldArticle;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ParseArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:articles {date : format yyyy-mm-dd Parse articles after given date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse articles data from old DB';
    protected $imageService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ImageService $imageService)
    {
        parent::__construct();
        $this->imageService = $imageService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {

        $paths = [
            'oldPath' => ImageService::OLD_ARTICLES_PATH,
            'newPath' => ImageService::ARTICLES_PATH
        ];

        DB::unprepared("SELECT SETVAL('images_id_seq', (SELECT MAX(id) + 1 FROM images))");
        DB::unprepared("SELECT SETVAL('articles_id_seq', (SELECT MAX(id) + 1 FROM articles))");


        $date = $this->argument('date');
        $fromDate = Carbon::createFromFormat('Y-m-d', $date);


        $this->info('Start parsing articles...');

        $this->newLine();
        $this->line('Parsing articles');

        $oldArticles = OldArticle::whereDate('date', '>', $fromDate)->get();

        $bar = $this->output->createProgressBar($oldArticles->count());

        $bar->start();

        foreach ($oldArticles as $oldArticle) {

            $article = Article::create(
                [

                    'user_id' => null,
                    'title' => $oldArticle->title,
                    'slug' => $oldArticle->slug,
                    'announce' => $oldArticle->announce,
                    'body' => $oldArticle->body,
                    'show_in_rss' => $oldArticle->show_in_rss,
                    'yatextid' => $oldArticle->yatextid,
                    'created_at' => $oldArticle->date,
                    'updated_at' => $oldArticle->updatedat,
                    'published_at' => $oldArticle->from_date,
                ]
            );

            $authors = $oldArticle->authors()->where('stream_id', 16)->get()->pluck('id');

            $article->authors()->attach($authors);

            try {
                $newImage = $this->imageService->storeOld($oldArticle->image, $paths['oldPath'], $paths['newPath']);
                $article->images()->save($newImage);
            } catch (\Throwable $exception) {

                Log::info($exception->getMessage(), ['Old article id' => $oldArticle->id]);

            }


            $bar->advance();
        }

        $bar->finish();



        $this->newLine();
        $this->info('All articles processed!');

        return 1;
    }
}
