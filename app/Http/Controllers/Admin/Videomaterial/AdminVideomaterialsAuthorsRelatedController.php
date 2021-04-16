<?php

namespace App\Http\Controllers\Admin\Videomaterial;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Author\AdminAuthorCollection;
use App\Models\Videomaterial;
use Illuminate\Http\Request;

/**
 * Class AdminVideomaterialsAuthorsRelatedController
 * @package App\Http\Controllers\Admin\Videomaterial
 */
class AdminVideomaterialsAuthorsRelatedController extends Controller
{
    /**
     * @param Videomaterial $videomaterial
     * @return AdminAuthorCollection
     */
    public function index(Videomaterial $videomaterial)
    {
        return new AdminAuthorCollection($videomaterial->authors);
    }
}
