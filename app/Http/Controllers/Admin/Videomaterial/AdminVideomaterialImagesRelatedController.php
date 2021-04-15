<?php

namespace App\Http\Controllers\Admin\Videomaterial;

use App\Http\Resources\Admin\AdminImageCollection;
use App\Models\Videomaterial;
use App\Http\Controllers\{Controller};
use Illuminate\Http\Request;

/**
 * Class AdminVideomaterialImagesRelatedController
 * @package App\Http\Controllers\Admin\Videomaterial
 */
class AdminVideomaterialImagesRelatedController extends Controller
{
    /**
     * @param Videomaterial $videomaterial
     * @return AdminImageCollection
     */
    public function index(Videomaterial $videomaterial)
    {
        return new AdminImageCollection($videomaterial->images);
    }
}
