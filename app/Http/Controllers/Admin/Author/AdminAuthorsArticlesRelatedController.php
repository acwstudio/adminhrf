<?php

namespace App\Http\Controllers\Admin\Author;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Article\AdminArticleCollection;
use App\Models\Author;
use Illuminate\Http\Request;

/**
 * Class AdminAuthorsArticlesRelatedController
 * @package App\Http\Controllers\Admin\Author
 */
class AdminAuthorsArticlesRelatedController extends Controller
{
    /**
     * @param Author $author
     * @return AdminArticleCollection
     */
    public function index(Author $author)
    {
        return new AdminArticleCollection($author->articles);
    }
}
