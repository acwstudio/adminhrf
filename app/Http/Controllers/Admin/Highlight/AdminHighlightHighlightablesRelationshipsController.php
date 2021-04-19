<?php

namespace App\Http\Controllers\Admin\Highlight;

use App\Http\Controllers\Controller;
use App\Http\Requests\Highlight\HighlightBookmarksUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminBookmarkIdentifierResource;
use App\Http\Resources\Admin\AdminHighlightableResource;
use App\Models\Highlight;
use Illuminate\Http\Request;

/**
 * Class AdminHighlightHighlightablesRelationshipsController
 * @package App\Http\Controllers\Admin\Highlight
 */
class AdminHighlightHighlightablesRelationshipsController extends Controller
{
    /**
     * @param Highlight $highlight
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Highlight $highlight)
    {
        return AdminHighlightableResource::collection($highlight->highlightable);
    }

    /**
     * @param HighlightBookmarksUpdateRelationshipsRequest $request
     * @param Highlight $highlight
     * @return mixed
     */
    public function update(HighlightBookmarksUpdateRelationshipsRequest $request, Highlight $highlight)
    {
        $highlightables =  $request->input('data');
        if (!empty($highlightables)) {

            $highlight->highlightable()->delete();

            foreach ($highlightables as $highlightable) {

                $highlight->highlightable()->create([
                    'highlightable_type' => $highlightable['type'],
                    'highlightable_id' => $highlightable['id'],
                    'is_additional' => $highlightable['is_additional'] ?? false,
                ]);
            }
        }
    }
}
