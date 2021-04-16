<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\TagsArticlesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Article\AdminArticleIdentifireResource;
use App\Models\Tag;
use Illuminate\Http\Request;

/**
 * Class AdminTagsArticlesRelationshipsController
 * @package App\Http\Controllers\Admin\Tag
 */
class AdminTagsArticlesRelationshipsController extends Controller
{
    /**
     * @param Tag $tag
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Tag $tag)
    {
        return AdminArticleIdentifireResource::collection($tag->articles);
    }

    /**
     * @param \App\Http\Requests\Tag\TagsArticlesUpdateRelationshipsRequest $request
     * @param Tag $tag
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(TagsArticlesUpdateRelationshipsRequest $request, Tag $tag)
    {
        return response('обновление тега для связанных статей отключено', 405);
    }
}
