<?php

namespace App\Http\Controllers\Admin\Highlight;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminImageCollection;
use App\Models\Highlight;
use Illuminate\Http\Request;

/**
 * Class AdminHighlightImagesRelatedController
 * @package App\Http\Controllers\Admin\Highlight
 */
class AdminHighlightImagesRelatedController extends Controller
{
    /**
     * @param Highlight $highlight
     * @return AdminImageCollection
     */
    public function index(Highlight $highlight)
    {
        return new AdminImageCollection($highlight->images);
    }
}
