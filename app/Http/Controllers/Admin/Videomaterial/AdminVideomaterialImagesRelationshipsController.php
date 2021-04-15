<?php

namespace App\Http\Controllers\Admin\Videomaterial;

use App\Http\Controllers\Controller;
use App\Http\Requests\Videomaterial\VideomaterialImagesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Models\Image;
use App\Models\Videomaterial;
use Illuminate\Http\Request;

/**
 * Class AdminVideomaterialImagesRelationshipsController
 * @package App\Http\Controllers\Admin\Videomaterial
 */
class AdminVideomaterialImagesRelationshipsController extends Controller
{
    /**
     * @param Videomaterial $videomaterial
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Videomaterial $videomaterial)
    {
        return AdminImagesIdentifierResource::collection($videomaterial->images);
    }

    /**
     * @param VideomaterialImagesUpdateRelationshipsRequest $request
     * @param Videomaterial $videomaterial
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(
        VideomaterialImagesUpdateRelationshipsRequest $request, Videomaterial $videomaterial)
    {
        $ids = $request->input('data.*.id');

        $messages = [];

        foreach ($ids as $id) {

            $image = Image::find($id);
            $result = $this->handleRelationships($image, $id);

            if ($result['result']) {
                $videomaterial->images()->save($image);
                array_push($messages, $result);
            } else {
                response();
                array_push($messages, $result);
            }

        }

        return response()->json($messages, 200);
    }

    /**
     * @param $image
     * @param $id
     * @return array
     */
    private function handleRelationships($image, $id)
    {
        if (!is_null($image) && is_null($image->imageable_id) && $image->imageable_type === 'videomaterial') {
            $message = [
                'id_image' => $image->id,
                'result' => true,
                'description' => 'Image ' . $id . ' was related to ' . 'videomaterial'
            ];

            return $message;

        } else {
            if (!$image) {
                $message = [
                    'id_image' => $image->id,
                    'result' => false,
                    'description' => 'Image ' . $id . ' is not exists'
                ];
            } else {
                if (!is_null($image->imageable_id)) {
                    $message = [
                        'id_image' => $image->id,
                        'result' => false,
                        'description' => 'Image ' . $id . ' already has ' . $image->imageable_type
                            . ' relation'
                    ];
                }
                if ($image->imageable_type !== 'videomaterial') {
                    $message = [
                        'id_image' => $image->id,
                        'result' => false,
                        'description' => 'Image ' . $id . ' will be related to ' . $image->imageable_type
                    ];
                }
            }
            return $message;
        }

    }
}
