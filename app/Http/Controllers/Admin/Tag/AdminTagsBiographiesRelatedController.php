<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Biography\AdminBiographyCollection;
use App\Models\Tag;
use Illuminate\Http\Request;

/**
 * Class AdminTagsBiographiesRelatedController
 * @package App\Http\Controllers\Admin\Tag
 */
class AdminTagsBiographiesRelatedController extends Controller
{
    /**
     * @param Tag $tag
     * @return AdminBiographyCollection
     */
    public function index(Tag $tag)
    {
        return new AdminBiographyCollection($tag->biographies);
    }
}
