<?php

namespace App\Http\Controllers\Admin\Biography;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminImageCollection;
use App\Models\Biography;
use Illuminate\Http\Request;

/**
 * Class AdminBiographyImagesRelatedController
 * @package App\Http\Controllers\Admin\Biography
 */
class AdminBiographyImagesRelatedController extends Controller
{
    /**
     * @param Biography $biography
     * @return AdminImageCollection
     */
    public function index(Biography $biography)
    {
        return new AdminImageCollection($biography->images);
    }
}
