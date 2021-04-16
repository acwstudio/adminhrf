<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Audiomaterial\AdminAudiomaterialCollection;
use App\Models\Tag;
use Illuminate\Http\Request;

/**
 * Class AdminTagsAudiomaterialsRelatedController
 * @package App\Http\Controllers\Admin\Tag
 */
class AdminTagsAudiomaterialsRelatedController extends Controller
{
    /**
     * @param Tag $tag
     * @return AdminAudiomaterialCollection
     */
    public function index(Tag $tag)
    {
        return new AdminAudiomaterialCollection($tag->audiomaterials);
    }
}
