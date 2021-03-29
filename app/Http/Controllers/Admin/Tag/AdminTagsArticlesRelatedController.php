<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminArticleCollection;
use App\Models\Tag;
use Illuminate\Http\Request;

/**
 * Class AdminTagsArticlesRelatedController
 * @package App\Http\Controllers\Admin\Tag
 */
class AdminTagsArticlesRelatedController extends Controller
{
    /**
     * @param Tag $tag
     * @return AdminArticleCollection
     */
    public function index(Tag $tag)
    {
        return new AdminArticleCollection($tag->articles);
    }
}
