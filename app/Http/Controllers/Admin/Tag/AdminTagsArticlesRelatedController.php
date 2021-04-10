<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Article\AdminArticleCollection;
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
     * @return \App\Http\Resources\Admin\Article\AdminArticleCollection
     */
    public function index(Tag $tag)
    {
        return new AdminArticleCollection($tag->articles);
    }
}
