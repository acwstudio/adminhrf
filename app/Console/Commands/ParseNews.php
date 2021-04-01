<?php

namespace App\Console\Commands;


use App\Models\News;
use App\Models\Old\News as OldNews;
use App\Services\ImageService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ParseNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:news {date : format yyyy-mm-dd Parse news after given date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse news data from old DB';
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
            'oldPath' => ImageService::OLD_NEWS_PATH,
            'newPath' => ImageService::NEWS_PATH
        ];

        DB::unprepared("SELECT SETVAL('images_id_seq', (SELECT MAX(id) + 1 FROM images))");
        DB::unprepared("SELECT SETVAL('news_id_seq', (SELECT MAX(id) + 1 FROM news))");


        $date = $this->argument('date');
        $fromDate = Carbon::createFromFormat('Y-m-d', $date);


        $this->info('Start parsing news...');

        $this->newLine();

        $oldNews = OldNews::whereDate('date', '>', $fromDate)->get();

        $bar = $this->output->createProgressBar($oldNews->count());

        $bar->start();

        foreach ($oldNews as $oldNew) {

            $article = News::create(
                [
                    'title' => $oldNew->title,
                    'announce' => $oldNew->announce,
                    'body' => $oldNew->body,
                    'close_commentation' => $oldNew->close_commentation,
                    'yatextid' => $oldNew->yatextid,
                    'created_at' => $oldNew->date,
                    'updated_at' => $oldNew->date,
                    'published_at' => $oldNew->published_at,
                ]
            );

            try {
                $newImage = $this->imageService->storeOld($oldNew->image, $paths['oldPath'], $paths['newPath']);
                $article->images()->save($newImage);
            } catch (\Throwable $exception) {

                Log::info($exception->getMessage(), ['Old news id' => $oldNew->id]);

            }

            $bar->advance();
        }

        $bar->finish();

        $this->newLine();
        $this->info('All news processed!');

        return 1;
    }
}
