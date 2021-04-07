<?php

namespace App\Http\Controllers\Admin\Podcast;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminImageCollection;
use App\Models\Podcast;
use Illuminate\Http\Request;

/**
 * Class AdminPodcastImagesRelatedController
 * @package App\Http\Controllers\Admin\Podcast
 */
class AdminPodcastImagesRelatedController extends Controller
{
    /**
     * @param Podcast $podcast
     * @return AdminImageCollection
     */
    public function index(Podcast $podcast)
    {
        return new AdminImageCollection($podcast->images);
    }
}
