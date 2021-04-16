<?php

namespace App\Http\Controllers\Admin\Audiomaterial;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminImageCollection;
use App\Models\Audiomaterial;
use Illuminate\Http\Request;

/**
 * Class AdminAudiomaterialImagesRelatedController
 * @package App\Http\Controllers\Admin\Audiomaterial
 */
class AdminAudiomaterialImagesRelatedController extends Controller
{
    /**
     * @param Audiomaterial $audiomaterial
     * @return AdminImageCollection
     */
    public function index(Audiomaterial $audiomaterial)
    {
        return new AdminImageCollection($audiomaterial->images);
    }
}
