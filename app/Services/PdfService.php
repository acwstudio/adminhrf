<?php


namespace App\Services;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Imagick;
use \Exception;
use Spatie\PdfToImage\Pdf;

class PdfService
{
    protected $pdfFile;

    protected $resolution = 144;

    protected $outputFormat = 'jpg';

    protected $validOutputFormats = ['jpg', 'jpeg', 'png'];

    protected $page = 1;

    public $imagick;

    public $imageService;

    protected $numberOfPages;

    public function __construct()
    {
        $this->imagick = new Imagick();
        $this->imageService = new ImageService();
    }

    public static function make(string $pdfFile)
    {
        return (new PdfService())->setPdf($pdfFile);
    }

    public function setPdf(string $pdfFile)
    {
        if (! file_exists($pdfFile)) {
            throw new Exception("File `{$pdfFile}` does not exist");
        }

        $this->imagick->pingImage($pdfFile);

        $this->numberOfPages = $this->imagick->getNumberImages();

        $this->pdfFile = $pdfFile;

        return $this;
    }


    public function setResolution(int $resolution)
    {
        $this->resolution = $resolution;

        return $this;
    }

    public function setOutputFormat(string $outputFormat)
    {
        if (! in_array($outputFormat, $this->validOutputFormats)) {
            throw new Exception("Format {$outputFormat} is not supported");
        }

        $this->outputFormat = $outputFormat;

        return $this;
    }

    public function getOutputFormat(): string
    {
        return $this->outputFormat;
    }



    public function setPage(int $page)
    {
        if ($page > $this->getNumberOfPages() || $page < 1) {
            throw new Exception("Page {$page} does not exist");
        }

        $this->page = $page;

        return $this;
    }

    public function getNumberOfPages(): int
    {
        return $this->numberOfPages;
    }


    public function saveAllPagesAsImages(string $imageableType = 'document'): Collection
    {
        $result = collect([]);

        $numberOfPages = $this->getNumberOfPages();
        $pages = range(1, $numberOfPages);

        if ($numberOfPages === 0) {
            return $result;
        }

        foreach ($pages as $page) {
            $this->setPage($page);
            $imageData = $this->getImageData();

            $result->push($this->imageService->storeByType($imageData, $imageableType, $page));

        }

        return $result;
    }

    public function getImageData(): Imagick
    {
        /*
         * Reinitialize imagick because the target resolution must be set
         * before reading the actual image.
         */
        $this->imagick = new Imagick();

        $this->imagick->setResolution($this->resolution, $this->resolution);

        $this->imagick->readImage(sprintf('%s[%s]', $this->pdfFile, $this->page - 1));

        $this->imagick = $this->imagick->mergeImageLayers(Imagick::LAYERMETHOD_FLATTEN);

        $this->imagick->setFormat($this->outputFormat);

        return $this->imagick;
    }


    public function pdfFromImages($directory, $images)
    {

        $paths = $images->map(function ($item) {
            return Storage::path($item->original);
        });

        $pdf = new Imagick($paths->all());
        $filename = $directory . Str::random(40) . '.pdf';
        Storage::makeDirectory($directory);


        $pdf->setImageFormat('pdf');
        $pdf->writeImages(Storage::path($filename), true);

        return $filename;

    }



}


