<?php

namespace App\Console\Commands;

use App\Models\Document;
use App\Models\Old\Document as OldDocument;
use App\Models\DocumentCategory;
use App\Models\Old\DocumentCollection;
use App\Services\ImageService;
use App\Services\PdfService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ParseDocuments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:documents {--D|delete : Clear documents table and files before parse}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse old documents with images and pdf files';

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
    public function handle()
    {

        $delete = $this->option('delete');

        $this->info('Start processing documents...');

        if ($delete) {
            DocumentCategory::truncate();
            Document::truncate();
        }

        $this->info('Creating categories...');

        $collections = $this->withProgressBar(DocumentCollection::all(), function ($item) {
            DocumentCategory::create([
                'id' => $item->id,
                'title' => $item->name,
                'created_at' => $item->created_at,
                'updated_at' => now()
            ]);
        });

        $this->newLine();
        $this->info('Done!');


        $oldDocs = OldDocument::with(['image', 'file', 'gallery', 'category'])->cursor();

        $bar = $this->output->createProgressBar($oldDocs->count());

        $bar->start();

        foreach ($oldDocs as $oldDoc) {


            $doc = Document::create(
                [
                    'id' => $oldDoc->id,
                    'document_category_id' => $oldDoc->collection_id,
                    'title' => $oldDoc->name,
                    'announce' => $oldDoc->shortdescription,
                    'body' => $oldDoc->description,
                    'file' => null,
                    'document_date' => rescue(function () use ($oldDoc) {
                        return Carbon::createFromLocaleFormat('j F Y', 'ru', Str::beforeLast($oldDoc->documentdate, ' года'));
                    }),
                    'document_text_date' => $oldDoc->documentdate,
                    'options' => null,
                    'created_at' => $oldDoc->created_at,
                    'updated_at' => now()
                ]
            );

            if ($oldDoc->file) {

                $oldPath = ImageService::OLD_DOCS_PATH . ImageService::dirById($oldDoc->file->id) . DIRECTORY_SEPARATOR .  $oldDoc->file->provider_reference;
                $newPath = ImageService::DOCS_PATH . ImageService::dirById($oldDoc->id) . DIRECTORY_SEPARATOR .  $oldDoc->file->provider_reference;

                if (Storage::copy($oldPath, $newPath)) {
                    $doc->file = $newPath;
                }
                $pdf = PdfService::make(Storage::path($oldPath));
                $images = $pdf->saveAllPagesAsImages();

                if ($images->isNotEmpty()) {
                    $doc->images()->saveMany($images);
                }

                $doc->save();

            } else {

                $oldImages = optional($oldDoc->gallery)->images;

                if ($oldImages->isNotEmpty()) {

                    $images = $oldImages->map(function ($item, $key) {
                        return $this->imageService->store(Storage::path(ImageService::OLD_DOCS_PATH . ImageService::dirById($item->id) . DIRECTORY_SEPARATOR .  $item->provider_reference),
                            ImageService::DOCS_PREVIEW_PATH, $key, false, true, true);
                    });

                    $path = (new PdfService())->pdfFromImages(ImageService::DOCS_PATH . ImageService::dirById($oldDoc->id) . DIRECTORY_SEPARATOR, $images);

                    if ($images->isNotEmpty()) {
                        $doc->images()->saveMany($images);
                    }

                    $doc->file = $path;

                    $doc->save();


                } else {

                    $doc->delete();

                }

            }


            $bar->advance();
        }

        $bar->finish();

        DB::unprepared("SELECT SETVAL('documents_id_seq', (SELECT MAX(id) + 1 FROM documents))");

        return 1;
    }
}
