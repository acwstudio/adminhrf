<?php

namespace App\Http\Controllers\Admin\Videomaterial;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Tag\AdminTagCollection;
use App\Models\Videomaterial;
use Illuminate\Http\Request;

/**
 * Class AdminVideomaterialsTagsRelatedController
 * @package App\Http\Controllers\Admin\Videomaterial
 */
class AdminVideomaterialsTagsRelatedController extends Controller
{
    /**
     * @param Videomaterial $videomaterial
     * @return AdminTagCollection
     */
    public function index(Videomaterial $videomaterial)
    {
        return new AdminTagCollection($videomaterial->tags);
    }
}
