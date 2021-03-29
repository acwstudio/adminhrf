<?php

namespace App\Http\Controllers\Admin\Biography;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminTagCollection;
use App\Models\Biography;
use Illuminate\Http\Request;

/**
 * Class AdminBiographiesTagsRelatedController
 * @package App\Http\Controllers\Admin\Biography
 */
class AdminBiographiesTagsRelatedController extends Controller
{
    /**
     * @param Biography $biography
     * @return AdminTagCollection
     */
    public function index(Biography $biography)
    {
        return new AdminTagCollection($biography->tags);
    }
}
