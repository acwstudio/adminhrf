<?php

namespace App\Http\Controllers\Admin\Author;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminImageResource;
use App\Models\Author;
use Illuminate\Http\Request;

/**
 * Class AdminAuthorImageRelatedController
 * @package App\Http\Controllers\Admin\Author
 */
class AdminAuthorImageRelatedController extends Controller
{
    /**
     * @param Author $author
     * @return AdminImageResource
     */
    public function index(Author $author)
    {
        return new AdminImageResource($author->image);
    }
}
