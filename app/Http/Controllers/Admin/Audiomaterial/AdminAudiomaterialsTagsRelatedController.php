<?php

namespace App\Http\Controllers\Admin\Audiomaterial;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Tag\AdminTagCollection;
use App\Models\Audiomaterial;
use Illuminate\Http\Request;

/**
 * Class AdminAudiomaterialsTagsRelatedController
 * @package App\Http\Controllers\Admin\Audiomaterial
 */
class AdminAudiomaterialsTagsRelatedController extends Controller
{
    /**
     * @param Audiomaterial $audiomaterial
     * @return AdminTagCollection
     */
    public function index(Audiomaterial $audiomaterial)
    {
        return new AdminTagCollection($audiomaterial->tags);
    }
}
