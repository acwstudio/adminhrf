<?php

namespace App\Http\Controllers\Admin\Podcast;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminTagCollection;
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
     * @return AdminTagCollection
     */
    public function index(Podcast $podcast)
    {
        return new AdminTagCollection($podcast->tags);
    }
}
