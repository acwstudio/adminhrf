<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Biography;
use App\Models\Image;
use App\Models\Old\Event;
use App\Models\Old\Person;
use App\Services\ImageService;
use Illuminate\Console\Command;
use App\Models\Old\Article as OldArticle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ParseImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:images {entity : Process images by entity article|event|document|biography}
    {--D|delete : Be careful! It will delete ALL entity images}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resize and move images to new locations';

    protected $paths;
    protected $imageService;

    /**
     * Create a new command instance.
     *
     * @param ImageService $imageService
     */
    public function __construct(ImageService $imageService)
    {
        parent::__construct();
        $this->paths = collect([
            'article' => [
                'oldPath' => ImageService::OLD_ARTICLES_PATH,
                'oldPathEvents' => ImageService::OLD_EVENTS_PATH,
                'newPath' => ImageService::ARTICLES_PATH
            ],
            'biography' => [
                'oldPath' => ImageService::OLD_BIO_PATH,
                'newPath' => ImageService::BIO_PATH
            ]
        ]);
        $this->imageService = $imageService;

    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $entity = $this->argument('entity');
        if (!in_array($entity, ['article', 'event', 'document','biography'])) {
            $this->newLine();
            $this->error('Wrong argument passed, entity must be of type article|event|document|biography' );
            return 0;
        }

        $paths = $this->paths->get($entity);

        $delete = $this->option('delete');

        $this->info('Start processing images...');

        if ($delete) {

            if ($this->confirm('It will delete ALL '.$entity.' images. Do you wish to continue?')) {

                $this->line('Clearing images for ' . $entity);

                Storage::deleteDirectory($paths['newPath']);
                Storage::makeDirectory($paths['newPath']);

                Image::where('imageable_type', $entity)->delete();


            } else {
                return 0;
            }

        }

        $this->newLine();
        $this->line('Processing images');

        switch ($entity) {
            case 'article':

                // Process articles
                $oldArticles = OldArticle::cursor();

                $bar = $this->output->createProgressBar($oldArticles->count());
                $this->newLine();
                $this->line('Processing images for articles');

                $bar->start();

                foreach ($oldArticles as $oldArticle) {

                    try {
                        $newImage = $this->imageService->storeOld($oldArticle->image, $paths['oldPath'], $paths['newPath']);
                        $article = Article::find($oldArticle->id);
                        $article->images()->save($newImage);
                    } catch (\Throwable $exception) {

                        Log::info($exception->getMessage(), ['Old article id' => $oldArticle->id]);

                    }

                    $bar->advance();
                }

                $bar->finish();

                // Process events
                $events = Event::with('image')->cursor();

                $bar = $this->output->createProgressBar($events->count());
                $this->newLine();
                $this->line('Processing images for events');

                $bar->start();

                foreach ($events as $event) {

                    try {
                        $newImage = $this->imageService->storeOld($event->image, $paths['oldPathEvents'], $paths['newPath']);
                        $article = Article::where('slug', Str::of($event->slug)->append('-event'))->first();
                        $article->images()->save($newImage);
                    } catch (\Throwable $exception) {

                        Log::info($exception->getMessage(), ['Event id' => $event->id]);

                    }

                    $bar->advance();
                }

                $bar->finish();
                break;
            case 'biography':
                // Process biographies
                $biographies = Person::cursor();

                $bar = $this->output->createProgressBar($biographies->count());
                $this->newLine();
                $this->line('Processing images for biography');

                $bar->start();

                foreach ($biographies as $biography) {

                    try {
                        $newImage = $this->imageService->storeOld($biography->image, $paths['oldPath'], $paths['newPath']);
                        $bio = Biography::find($biography->id);
                        $bio->images()->save($newImage);
                    } catch (\Throwable $exception) {

                        Log::info($exception->getMessage(), ['Old article id' => $biography->id]);

                    }

                    $bar->advance();
                }

                $bar->finish();
                break;
        }




        $this->newLine();
        $this->info('All images processed!');

        return 1;
    }
}
