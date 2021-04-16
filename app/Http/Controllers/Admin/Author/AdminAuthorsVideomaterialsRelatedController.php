<?php

namespace App\Http\Controllers\Admin\Author;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Videomaterial\AdminVideomaterialCollection;
use App\Models\Author;
use Illuminate\Http\Request;

/**
 * Class AdminAuthorsVideomaterialsRelatedController
 * @package App\Http\Controllers\Admin\Author
 */
class AdminAuthorsVideomaterialsRelatedController extends Controller
{
    /**
     * @param Author $author
     * @return AdminVideomaterialCollection
     */
    public function index(Author $author)
    {
        return new AdminVideomaterialCollection($author->video);
    }
}
