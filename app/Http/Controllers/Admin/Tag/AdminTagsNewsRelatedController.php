<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\News\AdminNewsCollection;
use App\Models\Tag;
use Illuminate\Http\Request;

/**
 * Class AdminTagsNewsRelatedController
 * @package App\Http\Controllers\Admin\Tag
 */
class AdminTagsNewsRelatedController extends Controller
{
    /**
     * @param Tag $tag
     * @return AdminNewsCollection
     */
    public function index(Tag $tag)
    {
        return new AdminNewsCollection($tag->news);
    }
}
