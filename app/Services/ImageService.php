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

    public function storeOld(OldImage $oldImage, $dir = self::ARTICLES_PATH)
    {
        $imageModel = Image::create();
        $oldPath = self::OLD_ARTICLES_PATH . self::dirById($oldImage->id) . DIRECTORY_SEPARATOR . $oldImage->provider_reference;
        $newPath = $dir . self::dirById($imageModel->id) . DIRECTORY_SEPARATOR;
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


    public static function dirById(int $id)
    {
        return (string) ceil($id/1000);
    }


}
