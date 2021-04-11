<?php

namespace App\Http\Controllers\Admin\Podcast;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Tag\AdminTagCollection;
use App\Models\Podcast;
use Illuminate\Http\Request;

/**
 * Class AdminPodcastsTagsRelatedController
 * @package App\Http\Controllers\Admin\Podcast
 */
class AdminPodcastsTagsRelatedController extends Controller
{
    /**
     * @param Podcast $podcast
     * @return \App\Http\Resources\Admin\Test\AdminTagCollection
     */
    public function index(Podcast $podcast)
    {
        return new AdminTagCollection($podcast->tags);
    }
}
