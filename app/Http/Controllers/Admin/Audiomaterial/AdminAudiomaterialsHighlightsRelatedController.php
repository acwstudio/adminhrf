<?php

namespace App\Http\Controllers\Admin\Audiomaterial;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminHighlightCollection;
use App\Models\Audiomaterial;
use Illuminate\Http\Request;

/**
 * Class AdminAudiomaterialsHighlightsRelatedController
 * @package App\Http\Controllers\Admin\Audiomaterial
 */
class AdminAudiomaterialsHighlightsRelatedController extends Controller
{
    /**
     * @param Audiomaterial $audiomaterial
     * @return AdminHighlightCollection
     */
    public function index(Audiomaterial $audiomaterial)
    {
        return new AdminHighlightCollection($audiomaterial->highlights);
    }
}
