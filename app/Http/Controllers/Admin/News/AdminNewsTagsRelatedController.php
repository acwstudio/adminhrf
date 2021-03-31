<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminTagCollection;
use App\Models\News;
use Illuminate\Http\Request;

/**
 * Class AdminNewsTagsRelatedController
 * @package App\Http\Controllers\Admin\News
 */
class AdminNewsTagsRelatedController extends Controller
{
    /**
     * @param News $news
     * @return AdminTagCollection
     */
    public function index(News $news)
    {
        return new AdminTagCollection($news->tags);
    }
}
