<?php

namespace App\Http\Controllers\Admin\Timeline;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Article\AdminArticleCollection;
use App\Http\Resources\Admin\Article\AdminArticleResource;
use App\Models\Article;
use App\Models\Timeline;
use Illuminate\Http\Request;

/**
 * Class AdminTimelineArticleRelatedController
 * @package App\Http\Controllers\Admin\Timeline
 */
class AdminTimelineArticleRelatedController extends Controller
{
    /**
     * @param Timeline $timeline
     * @return \App\Http\Resources\Admin\Article\AdminArticleCollection
     */
    public function index(Timeline $timeline)
    {
        return ['message' => 'Is not ready'];
    }
}
