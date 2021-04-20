<?php

namespace App\Http\Controllers\Admin\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\AuthorCreateRequest;
use App\Http\Requests\Author\AuthorUpdateRequest;
use App\Http\Resources\Admin\Author\AdminAuthorCollection;
use App\Http\Resources\Admin\Author\AdminAuthorLightResource;
use App\Http\Resources\Admin\Author\AdminAuthorResource;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Models\Image;
use App\Services\ImageAssignmentService;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminAuthorController
 * @package App\Http\Controllers\Admin\Author
 */
class AdminAuthorController extends Controller
{
    /** @var ImageService  */
    private $imageService;

    /** @var ImageAssignmentService  */
    private $imageAssignment;

    /**
     * AdminArticleController constructor.
     * @param ImageService $imageService
     */
    public function __construct(ImageService $imageService, ImageAssignmentService $imageAssignment)
    {
        $this->imageService = $imageService;
        $this->imageAssignment = $imageAssignment;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AdminAuthorCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');

        $authors = QueryBuilder::for(Author::class)
            ->allowedIncludes(['articles', 'image', 'video'])
            ->allowedSorts(['id', 'birth_date', 'firstname'])
            ->jsonPaginate($perPage);

        return new AdminAuthorCollection($authors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AuthorCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AuthorCreateRequest $request)
    {

        $dataAttributes = $request->input('data.attributes');
        $dataRelArticles = $request->input('data.relationships.articles.data.*.id');
        $dataRelVideomaterials = $request->input('data.relationships.videomaterials.data.*.id');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');

        $author = Author::create($dataAttributes);

        if ($dataRelImages) {
            /** @see ImageAssignmentService creates a relationship Image to Author */
            $this->imageAssignment->assign($author, $dataRelImages, 'author');
        }

        $author->articles()->attach($dataRelArticles);
        $author->video()->attach($dataRelVideomaterials);

        return (new AdminAuthorResource($author))
            ->response()
            ->header('Location', route('admin.authors.show', [
                'author' => $author
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param Author $author
     * @return \App\Http\Resources\Admin\Author\AdminAuthorResource
     */
    public function show(Author $author)
    {
        $query = QueryBuilder::for(Author::class)
            ->where('id', $author->id)
            ->allowedIncludes(['articles', 'video', 'image'])
            ->allowedFilters('firstname')
            ->firstOrFail();

        return new AdminAuthorResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Author\AuthorUpdateRequest $request
     * @param Author $author
     * @return \App\Http\Resources\Admin\Author\AdminAuthorResource
     */
    public function update(AuthorUpdateRequest $request, Author $author)
    {
        $dataAttributes = $request->input('data.attributes');
        $dataRelArticles = $request->input('data.relationships.articles.data.*.id');
        $dataRelVideomaterials = $request->input('data.relationships.videomaterials.data.*.id');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');

        $author->update($dataAttributes);

        if ($dataRelImages) {
            /** @see ImageAssignmentService creates a relationship Image to Author */
            $this->imageAssignment->assign($author, $dataRelImages, 'author');
        }

        $author->articles()->sync($dataRelArticles);
        $author->video()->sync($dataRelVideomaterials);

        return new AdminAuthorResource($author);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Author $author
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Author $author)
    {
        $idArticles = $author->articles()->allRelatedIds();
        $idVideomaterials = $author->video()->allRelatedIds();

        $author->articles()->detach($idArticles);
        $author->video()->detach($idVideomaterials);

        $images = Image::where('imageable_id', $author->id)
            ->where('imageable_type', 'author')->get();

        foreach ($images as $image) {
            $this->imageService->delete($image);
        }

        $author->image()->delete();

        $author->delete();

        return response(null, 204);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function light()
    {
        $authors = QueryBuilder::for(Author::class)
            ->allowedSorts(['id', 'firstname', 'surname'])
            ->get();

        return AdminAuthorLightResource::collection($authors);
    }

}
