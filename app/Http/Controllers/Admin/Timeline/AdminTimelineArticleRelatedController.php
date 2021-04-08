<?php

namespace App\Http\Controllers\Admin\Timeline;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminArticleCollection;
use App\Http\Resources\Admin\AdminArticleResource;
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
     * @return AdminArticleCollection
     */
    public function index(Timeline $timeline)
    {
        return ['message' => 'Is not ready'];
    }
}
