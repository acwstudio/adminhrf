<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticleBookmarksUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminBookmarkIdentifierResource;
use App\Models\Article;
use App\Models\Bookmark;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class AdminArticleBookmarksRelationshipsController
 * @package App\Http\Controllers\Admin\Article
 */
class AdminArticleBookmarksRelationshipsController extends Controller
{
    /**
     * @param Article $article
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Article $article)
    {
        return AdminBookmarkIdentifierResource::collection($article->bookmarks);
    }

    /**
     * @param ArticleBookmarksUpdateRelationshipsRequest $request
     * @param Article $article
     * @return mixed
     */
    public function update(ArticleBookmarksUpdateRelationshipsRequest $request, Article $article)
    {
        return response()->json(['message' => 'Update bookmark action for article is disabled']);
    }
}
