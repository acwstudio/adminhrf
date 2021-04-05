<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminCommentCollection;
use App\Models\News;
use Illuminate\Http\Request;

/**
 * Class AdminNewsCommentsRelatedController
 * @package App\Http\Controllers\Admin\News
 */
class AdminNewsCommentsRelatedController extends Controller
{
    /**
     * @param News $news
     * @return AdminCommentCollection
     */
    public function index(News $news)
    {
        return new AdminCommentCollection($news->comments);
    }
}
