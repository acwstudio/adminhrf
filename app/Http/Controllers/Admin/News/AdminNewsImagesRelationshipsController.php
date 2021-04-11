<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\NewsImagesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Models\Image;
use App\Models\News;
use Illuminate\Http\Request;

/**
 * Class AdminNewsImagesRelationshipsController
 * @package App\Http\Controllers\Admin\News
 */
class AdminNewsImagesRelationshipsController extends Controller
{
    /**
     * @param News $news
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(News $news)
    {
        return AdminImagesIdentifierResource::collection($news->images);
    }

    /**
     * @param NewsImagesUpdateRelationshipsRequest $request
     * @param News $news
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(NewsImagesUpdateRelationshipsRequest $request, News $news)
    {
        $ids = $request->input('data.*.id');

        $messages = [];

        foreach ($ids as $id) {

            $image = Image::find($id);
            $result = $this->handleRelationships($image, $id);

            if ($result['result']) {
                $news->images()->save($image);
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
     * @param News $news
     * @param $id
     * @return array
     */
    private function handleRelationships($image, $id)
    {
        if (!is_null($image) && is_null($image->imageable_id) && $image->imageable_type === 'news') {
            $message = [
                'id_image' => $image->id,
                'result' => true,
                'description' => 'Image ' . $id . ' was related to ' . 'news'
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
                if ($image->imageable_type !== 'news') {
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
