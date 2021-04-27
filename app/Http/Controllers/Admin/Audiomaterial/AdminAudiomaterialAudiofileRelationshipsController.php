<?php

namespace App\Http\Controllers\Admin\Audiomaterial;

use App\Http\Controllers\Controller;
use App\Http\Requests\Audiomaterial\AudiomaterialAudiofileUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Audiofile\AdminAudiofileIdentifiersResource;
use App\Models\Audiofile;
use App\Models\Audiomaterial;
use Illuminate\Http\Request;

/**
 * Class AdminAudiomaterialAudiofileRelationshipsController
 * @package App\Http\Controllers\Admin\Audiomaterial
 */
class AdminAudiomaterialAudiofileRelationshipsController extends Controller
{
    /**
     * @param Audiomaterial $audiomaterial
     * @return AdminAudiofileIdentifiersResource
     */
    public function index(Audiomaterial $audiomaterial)
    {
        return new AdminAudiofileIdentifiersResource($audiomaterial->audiofile);
    }

    /**
     * @param AudiomaterialAudiofileUpdateRelationshipsRequest $request
     * @param Audiomaterial $audiomaterial
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(AudiomaterialAudiofileUpdateRelationshipsRequest $request,
                           Audiomaterial $audiomaterial)
    {
        $ids = $request->input('data.*.id');
        foreach ($ids as $id) {
            Audiofile::find($id)->update([
                'audiomaterial_id' => $audiomaterial->id
            ]);
        }
        return response(null, 204);
    }
}
