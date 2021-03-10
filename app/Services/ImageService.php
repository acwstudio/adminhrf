<?php


namespace App\Services;


use App\Models\Image;
use App\Models\Old\Image as OldImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as ImageFacade;
use Illuminate\Http\File;
use Illuminate\Http\Request;

class ImageService
{
    const WIDTH = 900;
    const MIN = 350;
    const QUALITY = 70;
    const IMG_EXTENSION = 'jpg';

    const ARTICLES_PATH = '/images/articles/';
    const OLD_ARTICLES_PATH = '/uploads/media/artworks/0001/';
    const OLD_EVENTS_PATH = '/uploads/media/event/0001/';
    const DOCS_PATH = 'files/docs';
    const DOCS_PREVIEW_PATH = '/images/docs';
    const OLD_DOCS_PATH = '/uploads/media/documents_upload/0001/';

    protected $width;
    protected $min;
    protected $quality;
    protected $ext;

    /**
     * ImageService constructor.
     * @param int $width
     * @param int $min
     * @param int $quality
     * @param string $ext
     */
    public function __construct(
        $width = self::WIDTH,
        $min = self::MIN,
        $quality = self::QUALITY,
        $ext = self::IMG_EXTENSION
    )
    {
        $this->width = $width;
        $this->min = $min;
        $this->quality = $quality;
        $this->ext = $ext;
    }

    /**
     * @param int|mixed $width
     */
    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    /**
     * @param int|mixed $min
     */
    public function setMin(int $min): void
    {
        $this->min = $min;
    }

    /**
     * Resize and store old image in new location
     *
     * @param OldImage $oldImage
     * @param $oldDir
     * @param $newDir
     * @return mixed
     * @throws \Exception
     */
    public function storeOld(OldImage $oldImage, $oldDir, $newDir)
    {
        $imageModel = Image::create();
        $oldPath = $oldDir . self::dirById($oldImage->id) . DIRECTORY_SEPARATOR . $oldImage->provider_reference;
        $newPath = $newDir . self::dirById($imageModel->id) . DIRECTORY_SEPARATOR;
        $newName = Str::random(40);


        if (Storage::exists($oldPath)) {

            $imageProcess = ImageFacade::make(Storage::get($oldPath));
            $imgMin = clone $imageProcess;
            $img = $imageProcess->widen($this->width)->encode($this->ext, $this->quality);

            if ($imgMin->width() >= $imgMin->height()) {
                $imgMin = $imgMin->heighten($this->min)->encode($this->ext, $this->quality);
            } else {
                $imgMin = $imgMin->widen($this->min)->encode($this->ext, $this->quality);
            }

            if (Storage::put($newPath . $newName . '.' . $this->ext, $img->getEncoded()) &&
                Storage::put($newPath . $newName . '_min.' . $this->ext, $imgMin->getEncoded())
                ) {
                $imageModel->path = $newPath;
                $imageModel->name = $newName;
                $imageModel->ext = $this->ext;
                $imageModel->save();
            } else {
                $imageModel->delete();
                throw new \Exception('Сant write file  - ' . $newPath);
            }

        } else {
            $imageModel->delete();
            throw new \Exception('Old image file not found - ' . $oldPath);
        }

        return $imageModel;

    }

    /**
     * Delete image files from storage and model from db
     *
     * @param Image $image
     * @throws \Exception
     */
    public function delete(Image $image)
    {
        Storage::delete([$image->src, $image->preview, $image->original]);

        $image->delete();
    }


    /**
     * Return img directory name by id
     *
     * @param int $id
     * @return string
     */
    public static function dirById(int $id)
    {
        return Str::padLeft((string) ceil($id/1000), 2, '0');
    }



}
