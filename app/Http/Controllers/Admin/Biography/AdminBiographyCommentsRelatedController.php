<?php

namespace App\Http\Controllers\Admin\Biography;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminCommentCollection;
use App\Models\Biography;
use Illuminate\Http\Request;

/**
 * Class AdminBiographyCommentsRelatedController
 * @package App\Http\Controllers\Admin\Biography
 */
class AdminBiographyCommentsRelatedController extends Controller
{
    /**
     * @param Biography $biography
     * @return AdminCommentCollection
     */
    public function index(Biography $biography)
    {
        return new AdminCommentCollection($biography->comments);
    }
}
