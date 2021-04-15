<?php

namespace App\Http\Controllers\Admin\Biography;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminCommentCollection;
use App\Http\Resources\Admin\BioCategory\AdminBioCategoryCollection;
use App\Models\Biography;
use Illuminate\Http\Request;

/**
 * Class AdminBiographiesBioCategoriesRelatedController
 * @package App\Http\Controllers\Admin\Biography
 */
class AdminBiographiesBioCategoriesRelatedController extends Controller
{
    /**
     * @param Biography $biography
     * @return AdminBioCategoryCollection
     */
    public function index(Biography $biography)
    {
        return new AdminBioCategoryCollection($biography->categories);
    }
}
