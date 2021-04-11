<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticleImagesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Article\AdminArticleIdentifireResource;
use App\Models\Article;
use App\Models\Image;
use Illuminate\Http\Request;

/**
 * Class AdminArticleImagesRelationshipsController
 * @package App\Http\Controllers\Admin\Article
 */
class AdminArticleImagesRelationshipsController extends Controller
{
    /**
     * @param Article $article
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Article $article)
    {
        return AdminArticleIdentifireResource::collection($article->images);
    }

    /**
     * @param ArticleImagesUpdateRelationshipsRequest $request
     * @param Article $article
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(ArticleImagesUpdateRelationshipsRequest $request, Article $article)
    {
        $ids = $request->input('data.*.id');

        $messages = [];

        foreach ($ids as $id) {

            $image = Image::find($id);
            $result = $this->handleRelationships($image, $id);

            if ($result['result']) {
                $article->images()->save($image);
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
     * @param Article $article
     * @param $id
     * @return array
     */
    private function handleRelationships($image, $id)
    {
        if (!is_null($image) && is_null($image->imageable_id) && $image->imageable_type === 'article') {
            $message = [
                'id_image' => $image->id,
                'result' => true,
                'description' => 'Image ' . $id . ' was related to ' . 'article'
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
                if ($image->imageable_type !== 'article') {
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
