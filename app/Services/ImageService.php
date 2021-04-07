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
    const DOCS_PATH = 'files/docs/';
    const DOCS_PREVIEW_PATH = '/images/docs/';
    const BIO_PATH = '/images/biographies/';
    const NEWS_PATH = '/images/news/';
    const AUTHOR_PATH = '/images/author/';
    const TEST_PATH = '/images/test/';
    const QUESTION_PATH = '/images/question/';
    const ANSWER_PATH = '/images/answer/';
    const TIMELINE_PATH = '/images/timeline/';
    const VIDEOMATERIAL_PATH = '/images/videomaterial/';
    const AUDIOMATERIAL_PATH = '/images/audiomaterial/';
    const PODCAST_PATH = '/images/podcast/';
    const EVENT_PATH = '/images/event/';
    const DAYINHISTORY_PATH = '/images/dayinhistory/';
    const USER_PATH = '/images/user/';
    const COMMON_PATH = '/images/common/';
    const HIGHLIGHT_PATH = '/images/highlight/';


    // Old image paths TODO Delete after deploy new app

    const OLD_ARTICLES_PATH = '/uploads/media/artworks/0001/';
    const OLD_EVENTS_PATH = '/uploads/media/event/0001/';
    const OLD_DOCS_PATH = '/uploads/media/documents_upload/0001/';
    const OLD_BIO_PATH = '/uploads/media/person/0001/';
    const OLD_FILMS_PATH = '/uploads/media/films/0001/';
    const OLD_VIDEOLECTURES_PATH = '/uploads/media/educational/0001/';
    const OLD_DAYINHISTORY_PATH = '/uploads/media/dayInHistory/0001/';
    const OLD_NEWS_PATH = '/uploads/media/news/0001/';



    protected $width;
    protected $min;
    protected $quality;
    protected $ext;

    /**
     * @var array $paths // imageable_type and path substitution
     */
    public $paths = [
        'article' => self::ARTICLES_PATH,
        'document' => self::DOCS_PREVIEW_PATH,
        'news' => self::NEWS_PATH,
        'biography' => self::BIO_PATH,
        'author' => self::AUTHOR_PATH,
        'test' => self::TEST_PATH,
        'question' => self::QUESTION_PATH,
        'answer' => self::ANSWER_PATH,
        'timeline' => self::TIMELINE_PATH,
        'videomaterial' => self::VIDEOMATERIAL_PATH,
        'audiomaterial' => self::AUDIOMATERIAL_PATH,
        'event' => self::EVENT_PATH,
        'common' => self::COMMON_PATH,
        'dayinhistory' => self::DAYINHISTORY_PATH,
        'podcast' => self::PODCAST_PATH,
        'user' => self::USER_PATH,
        'highlight' => self::HIGHLIGHT_PATH

    ];

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

        $oldPath = $oldDir . self::dirById($oldImage->id) . DIRECTORY_SEPARATOR . $oldImage->provider_reference;
        $image = Storage::get($oldPath);

        if (Storage::exists($oldPath)) {

           return $this->store($image, $newDir);

        } else {

            throw new \Exception('Old image file not found - ' . $oldPath);
        }

    }

    public function storeByType($image, $imageableType = 'common')
    {
        switch ($imageableType) {
            case 'user':

                $this->setWidth(350);
                $this->setMin(100);

                break;
        }



        $image = $this->store($image, $this->paths[$imageableType]);
        $image->imageable_type = $imageableType;
        $image->save();

        return $image;
    }

    /**
     * Store image to given destination in chosen sizes and returns App/Models/Image instance
     *
     * @param mixed $image              //image can be a filepath, an Imagick object or a binary image data.
     * @param string $destination       //destination directory (with trailing slash)
     * @param bool $order               //order of image in sequence
     * @param bool $src                 //store standard image
     * @param bool $preview             //store preview image
     * @param bool $original            //store original image
     * @return Image
     * @throws \Exception
     */
    public function store($image, $destination, $order = false, $src = true, $preview = true, $original = false): Image
    {

        if ($src || $preview || $original) {


            $imageModel = Image::create();
            $newPath = $destination . self::dirById($imageModel->id) . DIRECTORY_SEPARATOR;
            $newName = Str::random(40);
            $flags = 0;


            if ($src) {
                if ($image instanceof \Imagick) {
                    $imageSrc = ImageFacade::make(clone $image);
                } else {
                    $imageSrc = ImageFacade::make($image);
                }

                $imageSrcString = $imageSrc->widen($this->width)->encode($this->ext, $this->quality)->getEncoded();

                $src = Storage::put($newPath . $newName . '.' . $this->ext, $imageSrcString);

                if ($src) {
                    $flags = $flags | Image::SRC_FLAG;
                }
            }

            if ($preview) {
                if ($image instanceof \Imagick) {
                    $imagePreview = ImageFacade::make(clone $image);
                } else {
                    $imagePreview = ImageFacade::make($image);
                }

                if ($imagePreview->width() >= $imagePreview->height()) {
                    $imagePreview = $imagePreview->heighten($this->min);
                } else {
                    $imagePreview = $imagePreview->widen($this->min);
                }
                $imagePreviewString = $imagePreview->encode($this->ext, $this->quality)->getEncoded();

                $preview = Storage::put($newPath . $newName . '_min.' . $this->ext, $imagePreviewString);

                if ($preview) {
                    $flags = $flags | Image::PREVIEW_FLAG;
                }
            }

            if ($original) {
                if ($image instanceof \Imagick) {
                    $imageOriginal = ImageFacade::make(clone $image);
                } else {
                    $imageOriginal = ImageFacade::make($image);
                }

                $imageOriginalString = $imageOriginal->encode($this->ext, $this->quality)->getEncoded();

                $original = Storage::put($newPath . $newName . '_original.' . $this->ext, $imageOriginalString);

                if ($original) {
                    $flags = $flags | Image::ORIGINAL_FLAG;
                }
            }

            if ($src || $preview || $original) {
                $imageModel->path = $newPath;
                $imageModel->name = $newName;
                $imageModel->ext = $this->ext;
                $imageModel->flags = $flags;

                if ($order) {
                    $imageModel->order = $order;
                }

                $imageModel->save();
            } else {
                $imageModel->delete();
                throw new \Exception('Сant write file  - ' . $newPath);
            }

        } else {
            throw new \Exception('Choose at least one type of final image');
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
