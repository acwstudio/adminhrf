<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Videomaterial\AdminVideomaterialCollection;
use App\Models\Tag;
use Illuminate\Http\Request;

/**
 * Class AdminTagsVideomaterialsRelatedController
 * @package App\Http\Controllers\Admin\Tag
 */
class AdminTagsVideomaterialsRelatedController extends Controller
{
    /**
     * @param Tag $tag
     * @return AdminVideomaterialCollection
     */
    public function index(Tag $tag)
    {
        return new AdminVideomaterialCollection($tag->videomaterials);
    }
}
