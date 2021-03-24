<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminArticleCollection;
use App\Models\Author;
use Illuminate\Http\Request;

/**
 * Class AdminAuthorsArticlesRelatedController
 * @package App\Http\Controllers\Admin
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
