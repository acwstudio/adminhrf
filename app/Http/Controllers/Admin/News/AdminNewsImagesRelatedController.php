<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminImageCollection;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Models\News;
use Illuminate\Http\Request;

/**
 * Class AdminNewsImagesRelatedController
 * @package App\Http\Controllers\Admin\News
 */
class AdminNewsImagesRelatedController extends Controller
{
    /**
     * @param News $news
     * @return AdminImageCollection
     */
    public function index(News $news)
    {
        return new AdminImageCollection($news->images);
    }
}
